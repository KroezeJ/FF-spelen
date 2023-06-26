<link rel="stylesheet" href="../style/buttons.css">

<?php

function button($text, $link, ?string $class = null)
{
        echo "<a href=$link class='button-33 $class'>$text</a>";
}

function submitButton($text)
{
        echo "<button type='submit' class='button-33'>$text</button>";
}

function card($title, $text, $link, $img)
{ ?>
        <div class="col-sm-4">
                <div data-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $text ?>" class="card">
                        <a href="actions/redirect.php?game=<?php echo $link ?>">
                                <div class="image">
                                        <img src="<?php echo $img ?>" alt="<?php echo $text ?>">
                                </div>
                                <div class="card-inner">
                                        <div class="header text-center">
                                                <h2><?php echo $title ?></h2>
                                        </div>
                                </div>
                        </a>
                </div>
        </div>
<?php }
