<?php

$fruits = "Apple , Apricot , Avocado , Banana , Bilberry , Blackberry , Blackcurrant , Blueberry , Boysenberry , Currant , Cherry , Cherimoya , Cloudberry , Coconut , Cranberry , Cucumber , Damson , Date_palm , Dragonfruit , Durian , Elderberry , Feijoa , Fig , Goji_berry , Gooseberry , Grape , Raisin , Grapefruit , Guava , Honeyberry , Huckleberry , Jabuticaba , Jackfruit , Jambul , Jujube , Juniperberry , Kiwifruit , Kumquat , Lemon , Lime , Loquat , Lychee , Mango , Mangosteen , Marionberry , Melon , Cantaloupe , Honeydew , Watermelon , MiracleFruit , Mulberry , Nectarine , Nance , Olive , Orange , BloodOrange , Clementine , Mandarine , Tangerine , Papaya , PassionFruit , Peach , Pear , Persimmon , Plantain , Plum , Prune , Pineapple , Plumcot , Pomegranate , Pomelo , PurpleMangosteen , Quince , Raspberry , Salmonberry , Rambutan , Redcurrant , Salal , Salak , Satsuma , Soursop , StarFruit , Strawberry , Tamarillo , Tamarind , UgliFruit , Yuzu , Avocado , ChiliPepper , Cucumber , Eggplant , Pea , SquashPlant , Tomato";
echo ("before : <br />");
echo ($fruits); //String
echo ("<br />");
echo ("<br />");

$fruits = explode(',', $fruits);
echo ("after : <br />");
var_dump($fruits); //Array
echo ("<br />");
echo ("<br />");

$revert = implode(",", $fruits);
echo ("revert : <br />");
echo ($revert); //String
echo ("<br />");
echo ("<br />");


$fruits_array = ['Apple','Apricot','Avocado','Banana','Bilberry','Blackberry','Blackcurrant','Blueberry','Boysenberry','Currant','Cherry','Cherimoya','Cloudberry','Coconut','Cranberry','Cucumber','Damson','Date_palm','Dragonfruit','Durian','Elderberry','Feijoa','Fig','Goji_berry','Gooseberry','Grape','Raisin','Grapefruit','Guava','Honeyberry','Huckleberry','Jabuticaba','Jackfruit','Jambul','Jujube','Juniperberry','Kiwifruit','Kumquat','Lemon','Lime','Loquat','Lychee','Mango','Mangosteen','Marionberry','Melon','Cantaloupe','Honeydew','Watermelon','MiracleFruit','Mulberry','Nectarine','Nance','Olive','Orange','BloodOrange','Clementine','Mandarine','Tangerine','Papaya','PassionFruit','Peach','Pear','Persimmon','Plantain','Plum','Prune','Pineapple','Plumcot','Pomegranate','Pomelo','PurpleMangosteen','Quince','Raspberry','Salmonberry','Rambutan','Redcurrant','Salal','Salak','Satsuma','Soursop','StarFruit','Strawberry','Tamarillo','Tamarind','UgliFruit','Yuzu','Avocado','ChiliPepper','Cucumber','Eggplant','Pea','SquashPlant','Tomato'];

$result = implode(" , ", $fruits_array);
echo ("revert : <br />");
echo ($result); //String