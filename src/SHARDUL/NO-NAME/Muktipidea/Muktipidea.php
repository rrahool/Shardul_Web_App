<?php
namespace App\Muktipidea;
use App\Model\Database as DB;

class Muktipidea extends DB
{
    public $id;
    public $blog_title;
    public $blog_post;
    public $blog_date;
    public $cetagory;
    public $freedom_fighter;
    public $question;
    public $accept;
    public $reject;
    public $question_id;
    public $answer;
    public $user_id;
    public $user_name;

    public function setdata($allpostdata = null){
        if (array_key_exists('id',$allpostdata)){
            $this->id = $allpostdata['id'];
        }
        if (array_key_exists('blog_title',$allpostdata)){
            $this->blog_title = $allpostdata['blog_title'];
        }
        if (array_key_exists('blog_post',$allpostdata)){
            $this->blog_post = $allpostdata['blog_post'];
        }
        if (array_key_exists('blog_date',$allpostdata)){
            $this->blog_date = $allpostdata['blog_date'];
        }
        if(array_key_exists('cetagory',$allpostdata))
        {
            $this->cetagory = $allpostdata['cetagory'];
        }
        if(array_key_exists('Freedom_fighter',$allpostdata)){
            $this->freedom_fighter = $allpostdata['Freedom_fighter'];
        }
        if(array_key_exists('question',$allpostdata)){
            $this->question = $allpostdata['question'];

        }
        if(array_key_exists('accept',$allpostdata)){
            $this->accept = $allpostdata['accept'];

        }
        if(array_key_exists('reject',$allpostdata)){
            $this->reject = $allpostdata['reject'];

        }
        if(array_key_exists('question_id',$allpostdata)){
            $this->question_id = $allpostdata['question_id'];

        }
        if(array_key_exists('answer',$allpostdata)){
            $this->answer = $allpostdata['answer'];

        }
        if(array_key_exists('user_id',$allpostdata)){
            $this->answer = $allpostdata['user_id'];

        }
        if(array_key_exists('userName',$allpostdata)){
            $this->user_name = $allpostdata['userName'];

        }

    }
}