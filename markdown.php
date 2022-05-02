<?php include 'includes/header.php'; ?>
<?php
$dir = __DIR__ . '/files';
$currentContent = "";
$currentFile = "";
function clean_string($string)
{
    $string = str_replace(' ', '-', $string);
}
function get_files_listing($dir)
{
    $files = [];
    // Open a directory and read its contents
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (!in_array($file, ['.', '..'])) {
                    $files[] = $file;
                }
            }
            closedir($dh);
        }
    }
    return $files;
};

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['save-file']))) {

    $filename = isset($_POST['file']) ? $_POST['file'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;
    $filename = clean_string($filename);
    $myfile = fopen($dir . DIRECTORY_SEPARATOR . $filename . '.md', mode: 'w');
    $currentFile = $filename;
    $currentContent = $content;
    fwrite($myfile, $content);
    fclose($myfile);
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['view-file']))) {
    $selectedfile = isset($_POST['selectedfile']) ? $_POST['selectedfile'] : null;
    if ($selectedfile) {
        $currentFile = pathinfo($selectedfile, PATHINFO_FILENAME);
        $myfile = file_get_contents($dir . DIRECTORY_SEPARATOR . $selectedfile);
        $currentContent = $myfile;
    }
}
?>
<section>
    <h2>Markdown Generator</h2>
    <!-- View file -->
    <form method="post" class="markdown_form">
        Choose file to view:* <select name="selectedfile" required>
            <option>--Select a file--</option>
            <?php foreach (get_files_listing($dir) as $file) : ?>
                <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
            <?php endforeach; ?>
        </select> <br>
        <button type="submit" name="view-file">View</button><br>
        <!-- Write file-->
        New File: <input type="text" name="file" placeholder="File name..." value="<?php echo $currentFile; ?>"> <br />
        <textarea id="file-input" name="content" id="" cols="30" rows="10" placeholder="File content...">
            <?php echo $currentContent; ?>
        </textarea><br>
        <button type="submit" name="save-file">Post</button>
        <script>
            var simplemde = new SimpleMDE({
                element: document.getElementById("file-input")
            });
        </script>
    </form>
</section>