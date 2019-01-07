## update data from another table match by ID

```
update products INNER JOIN manufacturers
    set products.manufacturer_id = manufacturers.id
    where products.manufacturer = manufacturers.name
```

## Left Join

```
SELECT cm.comment_id, `comment_author`,  `comment_post_ID`, `comment_content`, `meta_value` as rating, `comment_date`
    FROM `wp_commentmeta` AS cm
    LEFT JOIN `wp_comments` AS c
    ON c.comment_ID = cm.comment_id
    WHERE (`comment_approved` = "1")
```

## Update

```
UPDATE `wp_comments` 
    SET `comment_approved` = 1010
    WHERE (`comment_ID` = "123")
```

## Grant new user & password to new database

```
GRANT ALL PRIVILEGES ON DBNAME.* TO 'DBUSER'@'%' IDENTIFIED BY 'DBPASSWORD';
```

## Create New UTF8 databases

```
CREATE DATABASE mydb DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
```

## Wordpress migration to new domain

```
UPDATE wp_options SET option_value = replace(option_value, 'http://www.oldurl', 'http://www.newurl');
UPDATE wp_posts SET guid = replace(guid, 'http://www.oldurl','http://www.newurl');
UPDATE wp_posts SET post_content = replace(post_content, 'http://www.oldurl', 'http://www.newurl');
UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://www.oldurl','http://www.newurl');
```