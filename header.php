<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="سامانه سجاد اداره کل برنامه ریزی و بودجه">
    <meta name="keywords" content="ابراهیم حداد">
    <meta name="author" content="Ebrahim Haddad tel: +989111308122 email: blacksmith80@gmail.com">
    <link href="<?php echo $folder; ?>css/bahr.css" rel="stylesheet">
    <link rel="icon" href="<?php echo $folder; ?>img/sajjad.gif" type="image/gif" sizes="32x32">
    <link href="<?php echo $folder; ?>css/jquery.dataTables.min.css" rel="stylesheet">
<!-- Copied from Mali -->
    <link href="<?php echo $folder; ?>css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo $folder; ?>css/font-awesome.min.css" rel="stylesheet">

    <script src="<?php echo $folder; ?>js/min.js"></script>
    <script src="<?php echo $folder; ?>js/jquery.dataTables.min.js"></script>

    <?php
    echo '<title>' . $title . '</title>';
    echo '<link href="' . $folder . 'css/index.css" rel="stylesheet" type="text/css">';
    // ---- Random Hadis
    mysqli_query($hadis, "SET NAMES 'utf8'");
    mysqli_query($hadis, "SET CHARACTER SET 'uft8'");
    mysqli_query($hadis, "SET character_set_connection 'utf8'");
    $res = mysqli_query($hadis, "SELECT count(*) FROM `daily`");
    $row = mysqli_fetch_array($res);
    $rnd = rand(1, $row[0]);
    $que = "SELECT * FROM `daily` WHERE iddaily =" . $rnd;
    $res = mysqli_query($hadis, $que);
    $row = mysqli_fetch_array($res);
    $daily = $row[3] . ': ' . $row[1] . ' (' . $row[4] . ')';
    mysqli_close($hadis);

    ?>
    <script src="<?php echo $folder; ?>converter.js"></script>

    <script>
        function ConfirmDelete(a) {
            a = "آیا از " + a + " مطمئن هستید؟";
            if (confirm(a)) {
            }
            else {
                return false;
            }
        }

        function toda(Y_or_M) {
            var tod = new Date();
            var dd = String(tod.getDate()).padStart(2, '0');
            var mm = String(tod.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = tod.getFullYear();
            var dat = gregorian_to_jalali(yyyy, mm, parseInt(dd));
            switch (Y_or_M) {
                case 'Ymd':
                    return dat[0] + '/' + dat[1] + '/' + dat[2];
                case 'Y':
                    return dat[0];
                case 'm':
                    return dat[1];
                case 'd':
                    return dat[2];
            }
        }

        function today(b) {
            var tod = new Date();
            var dd = String(tod.getDate()).padStart(2, '0');
            var mm = String(tod.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = tod.getFullYear();
            var dat = gregorian_to_jalali(yyyy, mm, parseInt(dd));
            if (dat[1] < 10)dat[1] = "0" + dat[1];
            if (b = 3) return dat[0] + dat[1];
            if (b = 1) return dat[1];
            if (b = 0) return dat[0];
        }

        function showmoav() {
            var d = document.getElementById("salname").value + document.getElementById("mahname").value;
            return 'AAG' + d;
        }

        function moav() {
            document.getElementById("tblname").value = showmoav();
        }

        // does not work with negative and float numbers
        function decimalInt(inn) {
            inn = inn.toString();
            var b = inn.length % 3;
            var comma = Math.floor(inn.length / 3);
            var txt = "";
            if (b > 0) {
                txt += inn.substr(0, b);
                if (0 < comma)txt += ',';
            }
            for (i = 0; i < comma; i++) {
                txt += inn.substr(b + i * 3, 3);
                if (i + 1 < comma)txt += ',';
            }
            return txt;
        }
    </script>
</head>
<body>
<div id="main">
    <table width="100%">
        <tr>
            <th width="150px">
<?php
echo '          <img src="' . $folder . 'img/105.jpg" alt="آرم قوه" width="142" style="padding-right: 1em;">';
echo '      </th>';
echo '      <th width="450px">';
echo '          <h2 style="text-align: center;">' . $title . '</h2>';
echo '          <p>نام کاربر: ';
echo '<a href="' . $folder . 'pass.php"> 	';
echo $login_session . '</a></p>';
echo '          <p id="showDate" style="color: #808080; font-size: smaller;"></p>';
echo '          <script>document.getElementById("showDate").innerHTML = "تاریخ: "  + toda("Ymd");';
echo '          </script>';
echo '      </th>';
echo '      <th align="left"><img src="' . $folder . 'img/109.gif" width="210"></th>';
echo '  </tr>';
echo '</table>';
echo '<hr/><div style="color: #006600; text-align: center;">' . $daily . '</div>';

// -----------------------------main menu in all pages------------------------------------------//
echo '<div>';
echo '<ul>';
if (substr($group, 0, 2) == "00") $css = 'style="background-color: #006600;"'; else $css = '';
echo '   <li><a ' . $css . ' href="' . $folder . 'index.php">صفحه اصلی</a></li>';
if (hasPermit($user_check, 1100)) {
    if (substr($group, 0, 2) == "11") $css = 'style="background-color: #006600;"'; else $css = '';
    echo '<li class="dropdown">';
    echo '<a ' . $css . ' href="javascript:void(0)" class="dropbtn"> آمار</a>';
    echo '<div class="dropdown-content" >';
    if (hasPermit($user_check, 1110)) {
        echo '<a href="' . $folder . 'amar/jadval_karkard.php">جدول کارکرد</a>';
    }
    if (hasPermit($user_check, 1120)) {
        echo '<a href="' . $folder . 'amar/amar_amalkard_ghozat.php">ورود فرم آمار عملکرد قضات</a> ';
    }
    if (hasPermit($user_check, 1130)) {
        echo '<a href="' . $folder . 'amar/amar_amalkard_ghozat_view.php">رویت آمار عملکرد قضات</a> ';
    }
    if (hasPermit($user_check, 1140)) {
        echo '<a href="' . $folder . 'amar/amar_ghozat.php">رویت تعداد قضات</a>';
    }
    if (hasPermit($user_check, 1150)) {
        echo '<a href="' . $folder . 'amar/amar_karname.php">دانلود کارنامه قضات</a>  </div> ';
    }
    echo '</li>';
}
if (hasPermit($user_check, 2200)) {
    if (substr($group, 0, 2) == "22") $css = 'style="background-color: #006600;"'; else $css = '';
    echo '<li class="dropdown"><a ' . $css . ' href="javascript:void(0)" class="dropbtn">بهره وری</a>';
    echo '<div class="dropdown-content" >';
    if (hasPermit($user_check, 2210)) {
        echo '<a href="' . $folder . 'bahrevari/bahrevari_ghozat_shobe.php">بهره وری قضات در شعب</a>';
    }
    if (hasPermit($user_check, 2218)) echo '<a href="' . $folder . 'bahrevari/bahrevari_ghozat.php">جدول بهره وری کل قضات</a>';

    if (hasPermit($user_check, 2220)) {
        echo '<a href="' . $folder . 'bahrevari/bahrevari_mashin_daily.php">ورود عملکرد ماشین نویسان</a>';
    }
    if (hasPermit($user_check, 2230)) {
        echo '<a href="' . $folder . 'bahrevari/bahrevari_mashin_personnel.php"> مدیریت ماشین نویسان</a>';
    }
    if (hasPermit($user_check, 2240)) {
        echo '<a href="' . $folder . 'bahrevari/bahrevari_mashin.php">بهره وری ماشین نویسی</a> </div>';
    }
    echo '</li>';
}
if (hasPermit($user_check, 3300)) {
    if (substr($group, 0, 2) == "33") $css = 'style="background-color: #006600;"'; else $css = '';
    echo '<li class="dropdown"><a ' . $css . ' href="javascript:void(0)" class="dropbtn">گزارشات</a>';
    echo '<div class="dropdown-content">';
    if (hasPermit($user_check, 3310)) {
        echo '<a href="' . $folder . 'breport/exportghazi.php">گزارش کارکنان قضایی</a>';
    }
    if (hasPermit($user_check, 3320)) {
        echo '<a href="' . $folder . 'breport/access.php">دسترسی کاربران</a>';
    }
    if (hasPermit($user_check, 3330)) {
        echo '<a href="' . $folder . 'index.php">گزارش نقض آرا</a>';
    }
    if (hasPermit($user_check, 3340)) {
        echo '<a href="' . $folder . 'index.php">گزارش رتبه بندی قضات</a>';
    }
    if (hasPermit($user_check, 3350)) {
        echo '<a href="' . $folder . 'breport/ensha.php">گزارش انشاکنندگان</a>';
    }
    echo '</div>';
    echo '</li>';
}
if (hasPermit($user_check, 4400)) {
    if (substr($group, 0, 2) == "44") $css = 'style="background-color: #006600;"'; else $css = '';
    echo '<li class="dropdown"><a ' . $css . ' href="javascript:void(0)" class="dropbtn">بارگذاری</a>';
    echo '<div class="dropdown-content">';
    if (hasPermit($user_check, 4410)) {
        echo '<a href="' . $folder . 'amar/amar_import_excel.php">آپلود گزارشات آمار</a>';
    }
    if (hasPermit($user_check, 4415)) {
        echo '<a href="' . $folder . 'bargozari/bahrevari_formula.php">دستورالعملهای بهره وری</a>';
    }
    if (hasPermit($user_check, 4420)) {
        echo '<a href="' . $folder . 'bargozari/ghozat.php">آپدیت اطلاعات کارکنان</a>';
    }
    if (hasPermit($user_check, 4430)) {
        echo '<a href="' . $folder . 'bargozari/persons.php">مدیریت کارکنان</a>';
    }
    if (hasPermit($user_check, 4440)) {
        echo '<a href="' . $folder . 'bargozari/deletetables.php">حذف جداول</a>';
    }
    echo '</li>';
}
if (substr($group, 0, 2) == "55") $css = 'style="background-color: #006600;"'; else $css = '';
echo '<li ><a ' . $css . ' href="' . $folder . 'aboutme.php" >درباره سجاد</a></li>';
echo '<li ><a href = "' . $folder . 'logout.php" >خروج</a></li>';
echo '</ul>';
echo '</div>';

function hasPermit($user, $pageId)
{
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $ses_sql = mysqli_query($db, "SELECT accessType from userpermit where username = '$user'");
    while ($row = mysqli_fetch_assoc($ses_sql)) {
        if ($row['accessType'] == $pageId) return true;
    }
}

function date2text($text, $startChar)
{
    $year = substr($text, $startChar, 4);
    $month = substr($text, $startChar + 4, 2);
    return numericMonthToText($month) . ' ' . $year;
}

function lastmonth($thismonth)
{
    $year = substr($thismonth, 0, 4);
    $month = substr($thismonth, 4, 2);
    if ($month == '01') {
        $year = $year - 1;
        $month = '12';
    } else {
        $month = $month - 1;
    }
    return $year . str_pad($month, 2, '0', STR_PAD_LEFT);
}


// does not work with negative and float numbers
function decimalInt($inn)
{
    $b = strlen($inn) % 3;
    $comma = floor(strlen($inn) / 3);
    $txt = "";

    if ($b > 0) {
        $txt = $txt . substr($inn, 0, $b);
        if (0 < $comma) $txt = $txt . ',';
    }
    for ($i = 0; $i < $comma; $i++) {
        $txt = $txt . substr($inn, $b + $i * 3, 3);
        if ($i + 1 < $comma) $txt = $txt . ',';
    }
    return $txt;
}

function numericMonthToText($numericMonth)
{
    switch ($numericMonth) {
        case '01':
            return 'فروردین ماه';
        case '02':
            return 'اردیبهشت ماه';
        case '03':
            return 'خرداد ماه';
        case '04':
            return 'تیر ماه';
        case '05':
            return 'مرداد ماه';
        case '06':
            return 'شهریور ماه';
        case '07':
            return 'مهر ماه';
        case '08':
            return 'آبان ماه';
        case '09':
            return 'آذر ماه';
        case '10':
            return 'دی ماه';
        case '11':
            return 'بهمن ماه';
        case '12':
            return 'اسفند ماه';
        default:
            return 'Unknown input parameter';
    }
}

include_once $folder . 'converter.php';
function toda($Y_or_m)
{
    $dd = date('d');
    $yyyy = date('Y');
    if (date('m') == '01') {
        $yyyy = $yyyy - 1;
        $mm = '12';
    } else $mm = date('m') - 1;
    $dat = gregorian_to_jalali($yyyy, $mm, $dd);
    switch ($Y_or_m) {
        case 'Ymd':
            return $dat[0] + '/' + $dat[1] + '/' + $dat[2];
        case 'Y':
            return $dat[0];
        case 'm':
            return str_pad($dat[1], 2, '0', STR_PAD_LEFT);
        case 'd':
            return $dat[2];
        default:
            return 'format-error!';
    }
}
?>