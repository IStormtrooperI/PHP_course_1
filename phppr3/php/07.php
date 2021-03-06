<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Текст07</title>
    <meta charset="utf-8">
</head>
<body>
<?php
include('schet.php');

?>
Программный комплекс управления Интернет-магазином<p>
    Интернет-магазин или web-витрина?
<p>
    Осуществление продаж через Интернет - одна из сторон электронной коммерции. Все системы торговли через Интернет
    можно классифицировать как web-витрины, Интернет-магазины и Торговые Интернет Системы (ТИС). На сегодняшний день в
    России преобладают web-витрины, Интернет-магазины пребывают в меньшинстве, а ТИС отсутствуют. В чем же заключаются
    различия трех вышеупомянутых систем Интернет-торговли? Web-витрина представляет собой совокупность каталога, системы
    навигации и оформления заказа (с последующей передачей менеджеру для дальнейшей обработки), т.е. при помощи
    web-витрины организовывается торговля на заказ. Интернет-магазины и ТИС могут осуществлять полный торговый цикл в
    онлайновом режиме, но ТИС дополнительно полностью интегрирована в систему автоматизации внутреннего документооборота
    компании.
<p>
    В каждом случае имеет место продажа с применением Интернет-технологий, но в каждой из трех систем торговый процесс
    автоматизирован в разной степени. Соответственно разнятся как реализуемый уровень обслуживания покупателя, так и
    затраты на ведение торговли.
<p>
    Web-витрины - это относительно простые и недорогие сайты, представляющие товары торговой компании в виде
    стандартного каталога. Они могут производить операции оформления заказа, а иногда и выставление счета. На этом этапе
    работа с заказом переходит к менеджеру по продажам. Очевидно, что даже в случае полной реализации перечисленных
    возможностей, до полной автоматизации торгового процесса еще очень далеко. Необходимо как минимум связаться со
    складом, организовать доставку товара покупателю, принять оплату покупки. Параллельно требуется тщательное изучение
    спроса, проведение рекламных мероприятий и масса аналитической работы. Здесь нет места для реального уменьшения
    уровня операционных издержек, и даже при идеальном решении рентабельность web-витрины мало отличается от
    рентабельности обычных методов ведения торговли.
<p>
    Стоимость ПО для Интернет магазина выше как минимум на порядок, но и достижимая рентабельность также отличается от
    возможностей web-витрины. В общем случае техническую сторону любого Интернет-магазина можно рассматривать как
    совокупность web-витрины и торговой системы, которая и заменяет менеджеров по продажам. Системы Интернет-магазина
    выполняют большую часть задач, не решаемых в рамках web-витрины. В том числе, благодаря динамической обработке
    информации и работе с базами данных, Интернет-магазин имеет возможность работать индивидуально с каждым
    зарегистрировавшимся покупателем.
<p>

    Типовая структура Интернет-магазина
<p>
    Структура комплекса управления Интернет-магазином или торговой частью системы реализуется в виде трехзвенной
    архитектуры клиент/сервер (e-commerce.ru: "Системы управления Web-контентом: типовая структура"):
<p>
    Процесс обработки данных происходит по схеме "клиент - сервер приложений - база данных". Поступивший запрос
    обрабатывается сервером приложений, который в свою очередь связывается с хранилищем данных и платежной системой, а
    при наличии подключения к бизнес процессу организации, производит обмен данными с соответствующими системами.
<p>
    В общем случае минимум компонентов необходимых для функционирования Интернет-магазина включает в себя:
<p>
    Web-сервер - распределяет поступающие запросы, производит разграничение доступа;
    Сервер приложений - управляет работой всей системы, в частности бизнес-логикой Интернет-магазина ;
    СУБД - осуществляет хранение и обработку данных о товарах, клиентах, счетах и т.п.
    К этому комплексу подключаются платежные системы, а в некоторых случаях и системы доставки. Для полной интеграции с
    бизнес процессами компании может быть организован шлюз для электронной передачи данных между Интернет-магазином и
    внутренней системой автоматизации документооборота.
<p>

    Основные функции Интернет-магазина
<p>
    С технической точки зрения Интернет-магазин — это совокупность Web-витрины и Торговой системы - фронт-системы и
    бэк-офиса. Web-витрина предоставляет интерфейс к базе данных продаваемых товаров (в виде каталога, прайс-листа),
    работает с виртуальной торговой тележкой, оформляет заказы и регистрирует покупателя, предоставляет помощь
    покупателю в онлайновом режиме, передает информацию в торговую систему и обеспечивает безопасность личной информации
    покупателя. Далее торговая система осуществляет автоматическую обработку поступающих заказов - резервирует товар на
    складе, контролирует оплату и доставку товара.
<p>
    В общем случае основные функции Интернет-магазина — это информационное обслуживание покупателя, обработка заказов,
    проведение платежей, а также сбор и анализ различной статистической информации. Как было упомянуто выше, программный
    комплекс управления Интернет-магазином позволяет формировать и интерфейс с покупателем, и функциональные возможности
    Интернет-магазина, исходя из потребностей компании.
<p>

    Работа с покупателем
<p>
    Потенциальный клиент покидает Интернет-магазин гораздо легче, нежели реальные магазины. Это определяет уровень
    сервиса, предлагаемого в виртуальных магазинах. В тоже время особенности контакта с покупателем приводят к
    принципиальному различию предоставляемого сервиса реального и электронного магазинов.
<p>
    Каталог товаров. Полнота размещенной в каталоге информации, удобная структура и быстрый поиск во многом определяют
    успех магазина. Ведь именно здесь располагается вся доступная потенциальному клиенту информация о товаре, которая
    должна полностью компенсировать отсутствие образцов и продавца-консультанта. Значительную роль здесь могут играть 3D
    технологии, которые дают возможность "взять в руки" приглянувшийся образец, осмотреть его со всех сторон, открыть
    крышку и т.п. Однако использование 3D технологий выдвигает дополнительные требования к компьютеру клиента.
<p>
    Наличие на сайте самой полной информации, это еще не все. Клиенту нужно легко и быстро найти требующуюся информацию
    либо руководствуясь структурой каталога, либо используя систему поиска. В первом случае обычно требуется быстрая
    загрузка нужных страниц для получения первичной информации о товарах, а после этого, при необходимости,
    осуществляется переход к более подробному описанию. Во втором случае, помимо поиска по названию и основным
    характеристикам, требуется возможность осуществления поиска по контексту.
<p>
    Информационная поддержка покупателя. Потенциальный клиент должен иметь возможность в любой момент получить ответы на
    любой вопрос, сопутствующий покупке. Это условия послепродажного сервиса, консультации по особенностям схем оплаты и
    многое другое.
<p>
    Виртуальная торговая тележка. В процессе выбора товара формируется список отобранного товара - виртуальная "торговая
    тележка" или "корзинка". Как и в случае с реальной тележкой, любое наименование товара должно быть изъято в любой
    момент по желанию покупателя с последующим пересчетом общей стоимости покупки. И, разумеется, необходимо, чтобы
    текущее содержимое тележки отображалось постоянно. После окончания отбора товара наступает момент оформления заказа
    с выбором метода оплаты и доставки, а также регистрация покупателя. В тех случаях, когда выбор условий доставки
    произведен покупателем заранее, стоимость доставки может сразу учитываться при расчете общей стоимости покупки.
<p>
    Регистрация. Регистрация может происходить до или после выбора товаров. В первом случае создается регистрационный
    вход, которым могут воспользоваться постоянные клиенты магазина. Для них реализуется специальная система
    обслуживания и схема оплаты. Возможность регистрации после выбора товара позволяет покупателю сохранить анонимность
    и экономит время, если покупатель не принял решения что-либо купить в этом электронном магазине. Во время
    регистрации система обеспечивает безопасность личной информации покупателя, пользуясь при передаче данных
    защищенными каналами, например, протоколами SSL или SET.
<p>

    Обработка заказа
<p>
    Процесс обработки заказа начинается с проверки наличия товара и резервирования его на складе. При отсутствии части
    заказа система информирует покупателя о возможной задержке. Затем при оплате в онлайновом режиме инициируется запрос
    к выбранной платежной системе и при подтверждении оплаты заказа происходит оформление заказа на доставку товара.
    Покупатель со своей стороны может в онлайновом режиме получать информацию о прохождении заказа.
<p>

    Сбор маркетинговой информации
<p>
    Владелец виртуального магазина имеет возможность получать полную информацию о посетителях web-сайта и строить в
    соответствии с ней систему маркетинга. ПО Интернет-магазина позволяет не только собрать для анализа максимум
    статистической информации, но и оперативно ее использовать. Полученные результаты позволяют, например, выявить места
    магазина, оптимальные для размещения рекламной информации, а системы управления web-контентом (e-commerce.ru "Зачем
    нужны системы управления Web-контентом") позволяют автоматизировать ход рекламной кампании. Обычно публикация
    дополнительной информации реализуется при помощи отдельного сервера приложений (управляющего областью публикации) и
    соответствующей базы данных.
<p>

    Примеры
<p>
    INTERSHOP
<p>
    INTERSHOP 4 представляет собой полнофункциональную Торговую Интернет-Систему, в которой интегрированы все функции
    обычной торговой системы (ТС) и Интернет-торговли. Компанией eTopS Consulting разработан Русский Пакет: 1 для полной
    адаптации Интернет-магазинов на базе INTERSHOP к российским условиям ведения торгового процесса.
<p>

    Элит
<p>
    Торговая система Элит предназначена для создания как отдельных Интернет-магазинов, так и Торговых Рядов. ПО Элит
    размещается на web-узле, а правление Интернет-магазином производится с удаленного компьютера через терминалы
    продавцов, контролирующих отдельные номенклатуры товаров, и терминал мастер-продавца (управляющего магазина).
<p>

    UlterShop
<p>
    ТПакет программ UlterShop предназначен для создания Интернет-магазинов и может обслуживать розничную и оптовую
    торговлю одновременно. В основе технологии лежит архитектура клиент-сервер. Благодаря использованию JAVA в качестве
    языка программирования, UlterShop может быть размещен на серверах с любыми процессорами и ОС (UNIX, SunOs, Windows
    NT, Windows98 и др.), что в свою очередь обеспечивает масштабируемость системы. Для хранения и обработки данных
    возможно использование любых СУБД с языком запросов SQL (MS SQL Server, MS Access, Oracle, PostgreSQL и др.), а в
    качестве web-сервера - MS Internet Information Server, Apache и др.
<p>

    1С:Аркадия
<p>
    1С:Аркадия Интернет-магазин предназначено для создания Интернет-магазина на базе 1С:Торговля и Склад. Для работы
    системе требуются ОС Microsoft Windows NT Server 4.0, web-сервер Microsoft Internet Information Server (IIS) 3.0 и
    система 1С:Торговля и Склад 7.5 для хранения и обработки информации. В основе технологии лежит архитектура
    клиент-сервер.
<p>


</body>
</html>
