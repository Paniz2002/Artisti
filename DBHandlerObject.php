<?php

$dbh = new DBHandler();

if ($dbh->getInstance() === null) {
    die("No database connection");
}
