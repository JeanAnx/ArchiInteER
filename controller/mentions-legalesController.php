<?php

require 'model/db.php';

$mentions = getMentions();

require 'view/mentions-legalesView.phtml';
