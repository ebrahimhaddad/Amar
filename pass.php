<script>
    function checkRepeatedPass() {
        var txt2 = document.getElementById("text2").value;
        var txt3 = document.getElementById("text3").value;
        if (txt2 != txt3) document.getElementById("changePass").setAttribute("disabled", "disabled"); else document.getElementById("changePass").removeAttribute("disabled");
    }
</script>
<?php
$folder = "";
$title = "سامانه سجاد - تغییر رمز";
$group = "00";
include $folder . 'session.php';
require $folder . 'header.php';

$salname = toda('Y');
$mahname = toda('m');


$message = "";
if (isset($_POST["changePass"])) {
    $exPass = $_POST["text1"];
    $exPass = hash('sha256', $exPass);
    $newPass = $_POST["text2"];
    $newPass = hash('sha256', $newPass);
    $ses_sql = mysqli_query($db, "SELECT count(username) FROM admin WHERE username = '" . $user_check . "' AND passcode = '" . $exPass . "'");
    $ses_valid = mysqli_fetch_array($ses_sql);
    if ($ses_valid[0] > 0) {
        $que_sql = mysqli_query($db, "UPDATE `amar`.`admin` SET `passcode` = '" . $newPass . "' WHERE (`username` = '" . $user_check . "');");
        if ($que_sql == 1) $message = "تغییر رمز با موفقیت انجام شد!"; else $message = "تغییر رمز انجام نشد!";
    } else {
        $message = "رمز یا کد کاربری اشتباه است!";
    }
}
?>

<div style="padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
    <div class="row" style="margin:0.2rem;">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);">
            <h3 class="text-center bg-dark">تغییر رمز ورود</h3>

            <div class="row  ">
                <form action="" method="post">
                    <!--RIGHT-RIGHT CHEKBOX$TEXT area----->
                    <div class="col-md-7 ">
                        <!----first line---->
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    رمز فعلی
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control form-group-lg" type="password" name="text1"
                                       placeholder="رمز قبلی" required>
                            </div>
                        </div>
                        <div class="row"><label> </label></div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    رمز جدید
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control form-group-lg" type="password" id="text2" name="text2"
                                       placeholder="رمز انتخابی جدید" required>
                            </div>
                        </div>
                        <div class="row"><label> </label></div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    تکرار رمز جدید
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control form-group-lg" type="password" id="text3" name="text3"
                                       placeholder="رمز انتخابی جدید" required onfocusout="checkRepeatedPass()">
                            </div>
                        </div>
                    </div>
                    <!-----------right search-->
                    <div class="col-md-2 ">
                        <input type="submit" style="
  margin: 1rem;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.5;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  border: 1px solid transparent;
  border-radius: 4px;
  color: #d9534f;
  " id="changePass" name="changePass" value="تغییر رمز">
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <!-------------right table------------>
            <div class="row">
                <div style="position: relative; height: 200px; overflow: auto; display: block">
                    <p style="color:red;">
                        <?php echo $message; ?>
                    </p>

                    <p>
                        برای انتخاب پسورد جدید می توانید از حروف و اعداد تا حداکثر بیست کاراکتر بهره ببرید.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
</html>