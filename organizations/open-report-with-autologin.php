<?php 
    $groupToken = 'G-6syBMndeWPu.....';  //B2B Group Token
    $userEmail = 'test-user@example.com'; //Member email

    $formToken = $groupToken . '::' . \hash('sha256', $groupToken . \strtolower($userEmail));


    // 17884499 - is example of check id 
?>
<!DOCTYPE html>
<html>
    <body>
        <form method="post" action="https://plagiarismcheck.org/lms/public-report/17884499/" target="_blank">

            <input type="hidden" name="token" value="<?php echo $formToken ?>" />
            <input type="hidden" name="lms-type" value="api" />
            <input type="submit" />
        </form>
    </body>
</html>