<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/include/mainpage/head_scripts.php';
    // Создание рандомного массива
    $arr = [];
    for($i = 0; $i < 10; $i++) {
        $arr[$i] = rand(1, 10);
        echo $arr[$i] . '<br>';
    }
    // Выборка непарных элементов 1ый вариант
    $result = [];
    foreach ($arr as $j => $value_j) {
        $repeat = 0;
        foreach ($arr as $k => $value_k) {
            if ($j == $k) {
                continue;
            } else if ($value_j == $value_k) {
                $repeat++;
            }
        }
        $odd = false;
        if ($repeat == 0 || ($repeat % 2) == 0) {
            foreach ($result as $item) {
                if ($item == $value_j) {
                    $odd = true;
                }
            }
            if (!$odd || $repeat == 0) {
                $result[] = $value_j;
                // Если нужно вывести только один непарный элемент
                // break;
            }
        }
    }
    // Вывод
    echo 'Результат первый:' . '<br>';
    foreach ($result as $value) {
        echo $value . '<br>';
    }

    // Выборка и вывод непарных элементов 2ой вариант, если элементов непарных много
    echo 'Результат второй:' . '<br>';
    $ban_key = [];
    foreach ($arr as $i => $value) {
        if (count(array_keys($arr,  $value)) % 2 !== 0 && !in_array($i, $ban_key)) {
            echo $value . '<br>';
            // Если нужно вывести только один непарный элемент
            // break;
            foreach (array_keys($arr, $value) as $item) {
                $ban_key[] = $item;
            }
        }
    }
    // Выборка и вывод непарных элементов 3ий вариант
    echo 'Результат третий:' . '<br>';
    $arr_sort = $arr;
    sort($arr_sort);
    $sum = 1;
    for ($n = 0; $n < count($arr_sort); $n++) {
        if ($arr_sort[$n] == $arr_sort[$n+1]) {
            $sum++;
        } elseif (($sum % 2) != 0) {
            echo $arr_sort[$n]  . '<br>';
            $sum = 1;
            // Если нужно вывести только один непарный элемент
            // break;
        } else {
            $sum = 1;
        }
    }

    // Выборка и вывод непарных элементов 4ый вариант
    echo 'Результат четвертый:' . '<br>';
    $arr_count = array_count_values($arr);
    foreach ($arr_count as $i => $value) {
        if ($value % 2 != 0) {
            echo $i  . '<br>';
        }
    }