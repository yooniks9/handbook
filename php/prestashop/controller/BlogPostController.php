<?php

class BlogPostControllerCore extends FrontController
{
    public $php_self = 'blog-post';

    /**
     * Assign template vars related to page content
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();
        $post_id = Tools::getValue('id');
        if (!empty($post_id)){
            $single_post_path = _PS_ROOT_DIR_."/cachevar/postid-".$post_id.".txt";
            if(file_exists($single_post_path)&& (time()-filemtime($single_post_path)) <3000 && empty($_REQUEST["nocache"])){
                $single_content = file_get_contents($single_post_path);
            } else {
                $single_content = file_get_contents(_BLOG_URL_.'/wp-json/wp/v2/posts/'.$post_id);
                file_put_contents($single_post_path, $single_content);
            }
            // get author id
            $tmp = json_decode($single_content);
            $author_id = $tmp->author;

            $author_path = _PS_ROOT_DIR_."/cachevar/author-".$author_id.".txt";
            if(file_exists($author_path)&& (time()-filemtime($author_path)) <3000 && empty($_REQUEST["nocache"])){
                $author_name = file_get_contents($author_path);
            } else {
                $author_name = file_get_contents(_BLOG_URL_.'/wp-json/wp/v2/users/'.$author_id);
                file_put_contents($author_path, $author_name);
            }
            // get category
            $single_post_category_path = _PS_ROOT_DIR_."/cachevar/postid-".$post_id."-cat.txt";
            if(file_exists($single_post_category_path)&& (time()-filemtime($single_post_category_path)) <3000 && empty($_REQUEST["nocache"])){
                $content_category = file_get_contents($single_post_category_path);
            } else {
                $content_category = file_get_contents(_BLOG_URL_.'/wp-json/wp/v2/categories?post='.$post_id);
                file_put_contents($single_post_category_path, $content_category);
            }
            $content_category = json_decode($content_category, true);
                        
            $cats = [];
            foreach ($content_category as $key => $value) {
                $cats[] = $value['name'];
            }
            $blogVars = array(
                'single_content' => json_decode($single_content),
                'content_categories' => implode (", ", $cats),
                'author_name' => json_decode($author_name)->name
            );
            $this->context->smarty->assign($blogVars);
        }
        $this->setTemplate('blog/blog-post');
    }
}
