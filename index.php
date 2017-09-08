<?php

$a = "^(((((([2468][048])|([13579][26]))00)|(\d{2}((([2468][048])|([02468][48]))|([13579][26]))))[-/\s]?((((1[02])|(0?[13578]))[-/\s]?(([1-2][0-9])|(3[01])|(0?[1-9])))|(((11)|(0?[469]))[-/\s]?(([1-2][0-9])|(30)|(0?[1-9])))|(0?2[-/\s]?(([1-2][0-9]))|(0?[1-9]))))|((((([2468][1235679])|([13579][01345789]))00)|(\d{2}(([02468][1235679])|([13579][01345789]))))[-/\s]?((((1[02])|(0?[13578]))[-/\s]?(([1-2][0-9])|(3[01])|(0?[1-9])))|(((0?[469])|(11))[-/\s]?(([1-2][0-9])|(30)|(0?[1-9])))|(0?2[-/\s]?((1[0-9])|(2[0-8]))|(0?[1-9])))))$";

$ad = '((\d{2}(([02468][048])|([13579][26]))[-/\s]?((((0?[13578])|(1[02]))[-/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[-/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[-/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[-/s]?((((0?[13578])|(1[02]))[-/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[-/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[-/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))';


/*$f = memory_get_usage();
echo '开始内存：'.$f, PHP_EOL;

$tmp = [1,3,4,45,5,4,3,3,3,44,4,4,4,4,4];
$s = memory_get_usage();
echo '运行后内存：'.$s,PHP_EOL;
echo 'detal:'. ($s-$f),PHP_EOL;
$a = &$tmp;
//unset($tmp,$test->d);
$t = memory_get_usage();
echo '回到正常内存：'.$t.PHP_EOL;
echo 'detal-first: '.($t-$f);*/

/*$conn = mysqli_connect('localhost', 'root', 'root', 'local_test');
$sql = 'SELECT
	b.id bid,
	a.id aid,
	b.name bname,
	a.name aname
FROM
	category a INNER join  category b on a.LEVEL = b.LEVEL + 1 and a.lft> b.lft 
	and a.rgt < b.rgt AND b.lft > 1
ORDER BY
	a.level DESC;';

$res = mysqli_query($conn, $sql);

$data = [];
while ($d = mysqli_fetch_assoc($res)) {
    if (!isset($data[$d['bid']])) {
        $data[$d['bid']] = [
            'id' => $d['bid'],
            'name' => $d['bname'],
            'child' => []
        ];
    }

    if (isset($data[$d['aid']])) {
        array_push($data[$d['bid']]['child'], array_slice($data[$d['aid']], 0));
        unset($data[$d['aid']]);
    } else {
        array_push($data[$d['bid']]['child'], [
            'id' => $d['aid'],
            'name' => $d['aname'],
            'child' => []
        ]);
    }
}

echo json_encode($data);*/
