<?php
$api = 'https://www.tikwm.com/api/';
$vidurl = $_POST['url'] ?? '';
$tikUrl = $vidurl;
$postData = [
    'url' => $tikUrl,
    'hd' => 0 
];

$response = curl_request($api . '?' . http_build_query($postData));
$obj = json_decode($response);

$video = $obj->data->play ?? '';
$music = $obj->data->music ?? '';
$likes = $obj->data->digg_count ?? '';
$comments = $obj->data->comment_count ?? '';
$views = $obj->data->play_count ?? '';
$posts = $obj->data->share_count ?? '';
$downloads = $obj->data->download_count ?? '';

function curl_request($url, $postData = [])
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_ACCEPTTIMEOUT_MS, 10000);
    curl_setopt($curl, CURLOPT_ENCODING, 'gzip');

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
?>

<div class="result">
    <?php if (!empty($video)): ?>
    <h2>معلومات الفيديو</h2>
    <div class="video-container">
        <video controls style="display: block; margin: 0 auto; max-width: 100%; height: auto;">
            <source src="<?php echo htmlspecialchars($video); ?>" type="video/mp4">
            متصفحك لا يدعم تشغيل الفيديو.
        </video>
    </div>
    <p>عدد المشاهدات: <?php echo htmlspecialchars($views); ?></p>
    <p>عدد الإعجابات: <?php echo htmlspecialchars($likes); ?></p>
    <p>عدد التعليقات: <?php echo htmlspecialchars($comments); ?></p>
    <p>عدد المشاركات: <?php echo htmlspecialchars($posts); ?></p>
    <p>عدد التحميلات: <?php echo htmlspecialchars($downloads); ?></p>
    <div class="buttons">
        <a href="<?php echo htmlspecialchars($video); ?>" download="video.mp4" class="download-button">تحميل الفيديو</a>
        <a href="<?php echo htmlspecialchars($music); ?>" download="audio.mp3" class="download-button">تحميل الصوت</a>
    </div>
    <?php else: ?>
    <p>يرجى إدخال رابط فيديو صحيح.</p>
    <?php endif; ?>
</div>