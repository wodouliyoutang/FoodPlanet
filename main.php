<?php  
$file = 'Mobile_Food_Facility_Permit.csv'; // 替换为实际的 CSV 文件路径  
  
// 打开 CSV 文件  
$handle = fopen($file, 'r');  
  
// 检查文件是否成功打开  
if ($handle === false) {  
    die('无法打开 CSV 文件');  
}  
  
// 循环读取 CSV 文件中的行  
$foodlist = [];
$i = 0;
while (($row = fgetcsv($handle)) !== false) {  
    $columnData = $row[11]; 
  
    $i++;
    if ($i == 1) continue;
    $tmpList = explode(": ", $columnData);
    if (count($tmpList) > 0) {
        foreach ($tmpList as $tmpListV) {
            $foodlist[] = [
                "name" => $tmpListV
            ];
        }
    }

    if ($i == 50) break; // 暂时只读取51行记录
   
}  
  
// 关闭文件句柄  
fclose($handle);  

$jsonData = json_encode($foodlist);  
  
// 将JSON数据写入文件  
$file = 'data.json'; // 文件路径和名称  
file_put_contents($file, $jsonData);
