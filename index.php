<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}

include_once SYSTEM_FILES.'top.php';

?>
<h3>Hello, world!</h3>
Новая версия движка почти в строю, осталось только немного доработать...<br/>
Возможно, проект будет переименован, но пока все по прежнему.<br/>

Совершенно новое ядро, но все-таки используется страя идея, которая была ещё в самом первом ядре.<br/>
Код встраивается прямо в страницу, но теперь появится новый редактор страниц, котрый поможет вставить нужный контент не зная ни HTML, ни PHP.
CMS сможет работать в трех режимах:
<ul>
    <li>Обычный</li>
    <li>Для опытных пользователей</li>
    <li>Для разработчиков расширений</li>
</ul>

В обычном режиме будет минимум настроек и возможностей, зато все это позволит новым пользователям CMS освоится.<br/>
В режиме для опытных пользователей появятся все необходимые возможности для максимальной гибкости системы: от редактора HTML-кода до различных настроек оптимизации и безопасности.<br/>
В режиме разработчика CMS получит мини-IDE, в которой можно будет создавать расширения и тестировать их прямо на сайте.<br/>
<br/>
Для расширений будет организован централизированный сервер установки\обновления, с которого любой пользователь сможет скачать все, что ему нужно.<br/>
<?php include_once SYSTEM_FILES.'bottom.php';