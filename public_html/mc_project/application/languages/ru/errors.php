<?php

/**
 * Файл с переводами сообщений об ошибках
 *
 * @author Юрий Черниченко aka SID для http://citysites.com.ua
 */
return $errors = array(
	Zend_Validate_Alnum::NOT_ALNUM => "Значение содержит запрещенные символы. Разрешены символы латиници, кирилици, цифры и пробел",
	Zend_Validate_Alnum::STRING_EMPTY => "Поле не может быть пустым",
	Zend_Validate_Date::INVALID_DATE => "'%value%' не соответствует формату даты",
	Zend_Validate_Date::INVALID => 'Неверная дата',
	Zend_Validate_Date::FALSEFORMAT => 'Значение не соответствует указанному формату',
	Zend_Validate_EmailAddress::INVALID => "Неверный формат адреса электронной почты. Введите почту в формате local-part@hostname",
	Zend_Validate_EmailAddress::INVALID_FORMAT => "'%value%' неверный формат адреса электронной почты. Введите почту в формате local-part@hostname",
	Zend_Validate_EmailAddress::INVALID_HOSTNAME => "'%hostname%' неверный домен для адреса электронной почты '%value%'",
	Zend_Validate_EmailAddress::INVALID_MX_RECORD => "'%hostname%' не имеет MX-записи об адресе электронной почты '%value%'",
	Zend_Validate_EmailAddress::DOT_ATOM => "'%localPart%' не соответствует формату dot-atom",
	Zend_Validate_EmailAddress::QUOTED_STRING => "'%localPart%' не соответствует формату quoted-string",
	Zend_Validate_EmailAddress::INVALID_LOCAL_PART => "'%localPart%' неверное имя для адреса электронной почты '%value%'",
	Zend_Validate_Int::NOT_INT => 'Значение не является целочисленным значением',
	Zend_Validate_NotEmpty::IS_EMPTY => 'Поле не может быть пустым',
	Zend_Validate_StringLength::TOO_SHORT => 'Длина введённого значения меньше чем %min% символов',
	Zend_Validate_StringLength::TOO_LONG => 'Длина введённого значения больше чем %max% символов',
	Zend_Captcha_Word::BAD_CAPTCHA => 'Вы указали неверные символы',
	Zend_Captcha_Word::MISSING_VALUE => 'Поле не может быть пустым',
	'agreeRules' => 'Вы должны согласиться с правилами',
	Zend_Validate_Alpha::NOT_ALPHA => 'Введите в это поле только латинские символы',
	Zend_Validate_Alpha::STRING_EMPTY => 'Поле не может быть пустым. Заполните его, пожалуйста',
	Zend_Validate_Between::NOT_BETWEEN => '"%value%" не находится между "%min%" и "%max%", включительно',
	Zend_Validate_Between::NOT_BETWEEN_STRICT => '"%value%" не находится строго между "%min%" и "%max%"',
	Zend_Validate_Ccnum::LENGTH => '"%value%" должно быть численным значением от 13 до 19 цифр длинной',
	Zend_Validate_Ccnum::CHECKSUM => 'Подсчёт контрольной суммы неудался. Значение "%value%" неверно',
	Zend_Validate_Digits::NOT_DIGITS => 'Значение "%value%" неправильное. Введите только цифры',
	Zend_Validate_Digits::STRING_EMPTY => 'Поле не может быть пустым. Заполните его, пожалуйста',
	Zend_Validate_Float::NOT_FLOAT => '"%value%" не является дробным числом',
	Zend_Validate_GreaterThan::NOT_GREATER => '"%value%" не превышает "%min%"',
	Zend_Validate_Hex::NOT_HEX => '"%value%" содержит в себе не только шестнадцатеричные символы',
	Zend_Validate_Hostname::IP_ADDRESS_NOT_ALLOWED => '"%value%" - это IP-адрес, но IP-адреса не разрешены ',
	Zend_Validate_Hostname::UNKNOWN_TLD => '"%value%" - это DNS имя хоста, но оно не дожно быть из TLD-списка',
	Zend_Validate_Hostname::INVALID_DASH => '"%value%" - это DNS имя хоста, но знак "-" находится в неправильном месте',
	Zend_Validate_Hostname::INVALID_HOSTNAME_SCHEMA => '"%value%" - это DNS имя хоста, но оно не соответствует TLD для TLD "%tld%"',
	Zend_Validate_Hostname::UNDECIPHERABLE_TLD => '"%value%" - это DNS имя хоста. Не удаётся извлечь TLD часть',
	Zend_Validate_Hostname::INVALID_HOSTNAME => '"%value%" - не соответствует ожидаемой структуре для DNS имени хоста',
	Zend_Validate_Hostname::INVALID_LOCAL_NAME => '"%value%" - адрес является недопустимым локальным сетевым адресом',
	Zend_Validate_Hostname::LOCAL_NAME_NOT_ALLOWED => '"%value%" - адрес является сетевым расположением, но локальные сетевые адреса не разрешены',
	Zend_Validate_Identical::NOT_SAME => 'Значения не совпадают',
	Zend_Validate_Identical::MISSING_TOKEN => 'Не было введено значения для проверки на идентичность',
	Zend_Validate_InArray::NOT_IN_ARRAY => '"%value%" не найдено в перечисленных допустимых значениях',
	Zend_Validate_Ip::NOT_IP_ADDRESS => '"%value%" не является правильным IP-адресом',
	Zend_Validate_LessThan::NOT_LESS => '"%value%" не меньше, чем "%max%"',
	Zend_Validate_Regex::NOT_MATCH => 'Значение "%value%" не подходит под шаблон регулярного выражения "%pattern%"',
	Zend_Validate_File_Size::TOO_BIG => "Размер файла '%value%' не должен превышать '%max%', но размер загруженного файла '%size%'",
	Zend_Validate_File_Size::TOO_SMALL => "Размер файла '%value%' минимум '%min%', но размер загруженного файла '%size%'",
	Zend_Validate_File_Size::NOT_FOUND => "Файл '%value%' не найден",
	Zend_Validate_File_Extension::FALSE_EXTENSION => "Файл '%value%' имеет неверное расширение",
	Zend_Validate_File_Extension::NOT_FOUND => "Файл '%value%' не был найден",
);