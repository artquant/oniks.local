<?php

class MailSmtp {
	const CRLF = "\r\n";

	private static $server;
	private static $port;
	private static $protocol;
	private static $hostname;
	private static $socket;
	private static $connection_timeout = 30;
	private static $response_timeout = 8;
	private static $username;
	private static $password;
	private static $subject;
	private static $message;
	private static $charset = 'utf-8';
	private static $headers = array();
	private static $to = array();
	private static $cc = array();
	private static $bcc = array();
	private static $from = array();
	private static $reply_to = array();
	private static $attachments = array();


	/**
	 * Устанавливаем параметры для почтового сервера
	 *
	 * @param  string $server
	 * @param  int $port
	 * @param  string $hostname
	 * @return MailSmtp
	 */
	public static function set($server, $port = 465, $hostname = null) {
		self::$server = $server;
		self::$port = $port;
		self::$hostname = $hostname ?? gethostname();
		self::setHeader('X-Mailer', 'PHP/' . phpversion());
		self::setHeader('MIME-Version', '1.0');

		return new self();
	}

	/**
	 * Установка заголовков
	 *
	 * @param  mixed $key
	 * @param  mixed $value
	 * @return MailSmtp
	 */
	public static function setHeader($key, $value = null) {
		self::$headers[$key] = $value;

		return new self();
	}

	/**
	 * Формируем почтовый сервер
	 *
	 * @return string
	 */
	private static function getServer() {
		return (self::$protocol) ? self::$protocol . '://' . self::$server : self::$server;
	}

	/**
	 * Ответы сервера
	 *
	 * @return string
	 */
	private static function getResponse() {
		$response = '';

		stream_set_timeout(self::$socket, self::$response_timeout);

		while (($line = fgets(self::$socket, 515)) !== false) {
			$response .= trim($line) . "\n";

			if (substr($line, 3, 1) == ' ') break;
		}

		return trim($response);
	}

	/**
	 * Отправляем команды почтовому серверу
	 *
	 * @param  string $command
	 * @return void
	 */
	private static function sendCommand($command) {
		fputs(self::$socket, $command . self::CRLF);
	}

	/**
	 * Формируем email адреса
	 *
	 * @param  array $address
	 * @return string
	 */
	private static function formatAddress($address) {
		return (empty($address[1])) ? $address[0] : '"' . addslashes($address[1]) . '" <' . $address[0] . '>';
	}

	/**
	 * Формируем лист email адресов
	 *
	 * @param  array $addresses
	 * @return string
	 */
	private static function formatAddressList(array $addresses) {
		$data = array();

		foreach ($addresses as $address) {
			$data[] = self::formatAddress($address);
		}

		return implode(', ', $data);
	}

	/**
	 * Добавляем получаеля электронной почты
	 *
	 * @param  string $address
	 * @param  string|null $name
	 * @return MailSmtp
	 */
	public static function addTo($address, $name = null) {
		self::$to[] = array($address, $name);

		return new self();
	}

	/**
	 * Добавляем копию
	 *
	 * @param  string $address
	 * @param  string|null $name
	 * @return MailSmtp
	 */
	public static function addCc($address, $name = null) {
		self::$cc[] = array($address, $name);

		return new self();
	}

	/**
	 * Добавляем скрытую копию
	 *
	 * @param  string $address
	 * @param  string|null $name
	 * @return MailSmtp
	 */
	public static function addBcc($address, $name = null) {
		self::$bcc[] = array($address, $name);

		return new self();
	}

	/**
	 * Добавляем ответ по электронной почте
	 *
	 * @param  string $address
	 * @param  string|null $name
	 * @return MailSmtp
	 */
	public static function addReplyTo($address, $name = null) {
		self::$reply_to[] = array($address, $name);

		return new self();
	}

	/**
	 * Добавляем вложение файла
	 *
	 * @param  string $attachment
	 * @return MailSmtp
	 */
	public static function addAttachment($attachment) {
		if (file_exists($attachment)) {
			self::$attachments[] = $attachment;
		}

		return new self();
	}

	/**
	 * Установите проверку подлинности при входе по протоколу SMTP
	 *
	 * @param  string $username
	 * @param  string $password
	 * @return MailSmtp
	 */
	public static function setLogin($username, $password) {
		self::$username = $username;
		self::$password = $password;

		return new self();
	}

	/**
	 * Устанавливаем кодировку
	 *
	 * @param  string $charset
	 * @return MailSmtp
	 */
	public static function setCharset($charset) {
		self::$charset = $charset;

		return new self();
	}

	/**
	 * Устанавливаем протокол
	 *
	 * @param  string $protocol - ssl
	 * @return MailSmtp
	 */
	public static function setProtocol($protocol = 'ssl') {
		self::$protocol = $protocol;

		return new self();
	}

	/**
	 * устанавливаем адрес отправителья и или имя
	 *
	 * @param  string $address
	 * @param  string|null $name
	 * @return MailSmtp
	 */
	public static function setFrom($address, $name = null) {
		self::$from = array($address, $name);

		return new self();
	}

	/**
	 * Устанавливаем тему письма
	 *
	 * @param  string $subject
	 * @return MailSmtp
	 */
	public static function setSubject($subject) {
		self::$subject = $subject;

		return new self();
	}

	/**
	 * Сообщение
	 *
	 * @param  string $message
	 * @return MailSmtp
	 */
	public static function setMessage($message) {
		self::$message = $message;

		return new self();
	}

	/**
	 * Отправляем почту
	 *
	 * @param  bool $is_html
	 * @return bool
	 */
	public static function send($is_html = false) {
		$message = null;

		/* Устанавлиеваем сооединение с почтовым сервером */
		self::$socket = fsockopen(
			self::getServer(),
			self::$port,
			$errorNumber,
			$errorMessage,
			self::$connection_timeout
		);

		if (empty(self::$socket)) return false;

		self::sendCommand('EHLO ' . self::$hostname);
		self::sendCommand('AUTH LOGIN');
		self::sendCommand(base64_encode(self::$username));
		self::sendCommand(base64_encode(self::$password));
		self::sendCommand('MAIL FROM: <' . self::$from[0] . '>');

		$recipients = array_merge(self::$to, self::$cc, self::$bcc);

		foreach ($recipients as $address) {
			self::sendCommand('RCPT TO: <' . $address[0] . '>');
		}

		self::setHeader('Date', date('r'));
		self::setHeader('Subject', self::$subject);
		self::setHeader('From', self::formatAddress(self::$from));
		self::setHeader('Return-Path', self::formatAddress(self::$from));
		self::setHeader('To', self::formatAddressList(self::$to));

		if (!empty(self::$reply_to)) {
			self::setHeader('Reply-To', self::formatAddressList(self::$reply_to));
		}

		if (!empty(self::$cc)) {
			self::setHeader('Cc', self::formatAddressList(self::$cc));
		}

		if (!empty(self::$bcc)) {
			self::setHeader('Bcc', self::formatAddressList(self::$bcc));
		}

		$boundary = md5(uniqid(microtime(true), true));

		self::setHeader('Content-Type', 'multipart/mixed; boundary="mixed-' . $boundary . '"');

		if (!empty(self::$attachments)) {
			self::$headers['Content-Type'] = 'multipart/mixed; boundary="mixed-' . $boundary . '"';
			$message .= '--mixed-' . $boundary . self::CRLF;
			$message .= 'Content-Type: multipart/alternative; boundary="alt-' . $boundary . '"' . self::CRLF . self::CRLF;
		} else {
			self::$headers['Content-Type'] = 'multipart/alternative; boundary="alt-' . $boundary . '"';
		}

		$content_type = $is_html ? 'html' : 'plain';

		$message .= '--alt-' . $boundary . self::CRLF;
		$message .= 'Content-Type: text/' . $content_type . '; charset=' . self::$charset . self::CRLF;
		$message .= 'Content-Transfer-Encoding: base64' . self::CRLF . self::CRLF;
		$message .= chunk_split(base64_encode(self::$message)) . self::CRLF;

		$message .= '--alt-' . $boundary . '--' . self::CRLF . self::CRLF;

		if (!empty(self::$attachments)) {
			foreach (self::$attachments as $attachment) {
				$filename = pathinfo($attachment, PATHINFO_BASENAME);
				$contents = file_get_contents($attachment);
				$type = mime_content_type($attachment);

				if (!$type) $type = 'application/octet-stream';

				$message .= '--mixed-' . $boundary . self::CRLF;
				$message .= 'Content-Type: ' . $type . '; name="' . $filename . '"' . self::CRLF;
				$message .= 'Content-Disposition: attachment; filename="' . $filename . '"' . self::CRLF;
				$message .= 'Content-Transfer-Encoding: base64' . self::CRLF . self::CRLF;
				$message .= chunk_split(base64_encode($contents)) . self::CRLF;
			}

			$message .= '--mixed-' . $boundary . '--';
		}

		$headers = '';

		foreach (self::$headers as $k => $v) {
			$headers .= $k . ': ' . $v . self::CRLF;
		}

		self::sendCommand('DATA');
		self::sendCommand($headers . self::CRLF . $message . self::CRLF . '.');
		self::sendCommand('QUIT');

		fclose(self::$socket);

		return true;
	}
}

// $mail = MailSmtp::set('smtp.yandex.ru')
// 				::setProtocol('ssl')
// 				::setLogin('artquant@yandex.ru', 'qzbabmhskvynditg')
// 				::addTo('oneboyfriend@mail.ru')
// 				::setFrom('artquant@yandex.ru')
// 				::setSubject('Проверка сообщения')
// 				::setMessage('<strong>Это моё первое сообщение</strong>')
// 				::send(true);

// if ($mail) echo 'OK';