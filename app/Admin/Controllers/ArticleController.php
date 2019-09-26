<?php

namespace App\Admin\Controllers;

use App\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;

use App\AdminUser;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Article';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);

        $grid->column('id', 'ID');
        $grid->column('author_id', '作者')->display(function($authorId){
            return AdminUser::getAuthor($authorId);            
        });
        $grid->column('title', '标题');
        $grid->column('rate', '点击率');
        $grid->column('created_at', '发布时间')->date('Y-m-d');
        $grid->column('updated_at', '更新时间')->date('Y-m-d');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('author_id', '作者')->as(function($authorId){
            return AdminUser::getAuthor($authorId);
        });
        $show->field('title', '标题');
        $show->field('content', '内容')->unescape();
        $show->field('rate', '点击率');
        $show->field('created_at', '发布时间');
        $show->field('updated_at', '更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article);

    
        $form->text('title',    '标题');
        $form->editor('content', '内容');

        $form->hidden('author_id')->value(Admin::user()->id);

        return $form;
    }

}
