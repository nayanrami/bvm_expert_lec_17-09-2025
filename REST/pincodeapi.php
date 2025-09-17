<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pincode = $_POST['pincode'];

    // Validate pincode (should be 6 digits)
    if (!preg_match('/^\d{6}$/', $pincode)) {
        $error = "Please enter a valid 6-digit pincode.";
    } else {
        $url = "https://api.postalpincode.in/pincode/" . $pincode;
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data[0]['Status'] === 'Success') {
            $postOffices = $data[0]['PostOffice'];
        } else {
            $error = "No data found for this pincode.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pincode Lookup</title>
</head>
<body>

<h2>Enter Pincode</h2>
<form method="POST">
    <input type="text" name="pincode" required pattern="\d{6}" placeholder="Enter 6-digit pincode">
    <button type="submit">Search</button>
</form>

<?php if (isset($error)): ?>
    <p style="color: red"><?= $error ?></p>
<?php endif; ?>

<?php if (isset($postOffices)): ?>
    <h3>Post Offices for Pincode <?= htmlspecialchars($pincode) ?>:</h3>
    <ul>
        <?php foreach ($postOffices as $office): ?>
            <li>
                <strong><?= htmlspecialchars($office['Name']) ?></strong><br>
                Type: <?= htmlspecialchars($office['BranchType']) ?><br>
                District: <?= htmlspecialchars($office['District']) ?><br>
                State: <?= htmlspecialchars($office['State']) ?><br>
                Country: <?= htmlspecialchars($office['Country']) ?><br><br>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>
