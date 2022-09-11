<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
    CModule::IncludeModule('iblock');
    // Файл
    $filename = date('his_d.m.Y') . '.csv';
    $buffer   = fopen(__DIR__ . '/' . $filename, 'w');
    fputs($buffer, chr(0xEF) . chr(0xBB) . chr(0xBF));
    // Автор
    $arUser = CUser::GetByID(222012)->Fetch();
    $author = ["NAME"=>$arUser['NAME'], "LAST_NAME"=>$arUser['LAST_NAME'], "WORK_POSITION"=>$arUser['WORK_POSITION'], "PERSONAL_PHOTO"=>$arUser['PERSONAL_PHOTO']];
    // Элементы
    $articles = [];
    $arSelect = Array('ID', 'NAME', 'PROPERTY_RATING', 'PROPERTY_VISITS', 'DETAIL_PAGE_URL');
    $arFilter = Array(
        'IBLOCK_ID'      =>'65',
        'ACTIVE'         =>'Y',
        'PROPERTY_AUTHOR'=>'222012',
        '>=DATE_CREATE'  => '01.01.2017',
        '<=DATE_CREATE'  => '31.12.2021 23:59:59',
        'NAME'           => '%бух%'
    );
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    // Заголовок таблицы
    $keys = ['ID', 'Название статьи', 'Автор', 'Должность автора', 'Фотография автора', 'Рейтинг', 'Количество просмотров', 'Ссылка на детальную страницу'];
    fputcsv($buffer, $keys, ',');
    // Массив в файл
    while($ob = $res->GetNext())
    {
        $articles[] = [
            'ID'                        => $ob['ID'],
            'NAME'                      => $ob['NAME'],
            'AUTHOR_NAME'               => $author['NAME'].' '.$author['LAST_NAME'],
            'AUTHOR_WORK_POSITION'      => $author['WORK_POSITION'],
            'AUTHOR_PERSONAL_PHOTO'     => $author['PERSONAL_PHOTO'],
            'RATING'                    => $ob['PROPERTY_VOTE_RATING_VALUE'] ?: 0,
            'VISITS'                    => $ob['PROPERTY_VISITS_VALUE'] ?: 0,
            'DETAIL_PAGE_URL'           => $ob['DETAIL_PAGE_URL'],
        ];
        foreach ($articles as $article) {
            fputcsv($buffer, $article, ',');
        }
    }
    fclose($buffer);
    ?>

<a href="<?= $filename ?>">Скачать файл</a>
<?php exit(); ?>
