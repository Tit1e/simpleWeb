<?php
namespace Home\Controller;
use Common\Model\QiniuModel;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function userInfo(){
        $user_id = session('user.user_id');
        if(!$user_id){
            $this->ajaxReturn(array('code'=>-1,'msg'=>'用户未登录'));
        }else{
            $uer_info = M('user')->where(array('user_id'=>$user_id))->field("nick_name,create_time")->select();
            $this->ajaxReturn(array('uer_info'=>$uer_info));
        }
    }
    public function login_out(){
        session(null);
        $this->ajaxReturn(array('code'=>1,'msg'=>'退出登录'));
    }
    public function user_dy(){
        $user_id = I('user_id');
        $uer_info = M('user')->where(array('user_id'=>$user_id))->field("nick_name,create_time")->select();
        $this->assign('uer_info',$uer_info);
        $this->display();
    }
    // 某动态
    public function dy_info(){
        $dynamic = M('dynamic');
        $dynamic_id = I('dynamic_id');
        $now = time();
        $tody = strtotime(date('Y-m-d', time()));
        $year = date("Y", $now);
        $result = $dynamic
            ->where(array('dynamic_id'=>$dynamic_id))
            ->join('user ON dynamic.user_id = user.user_id')    //连表查询结果
            ->field('nick_name,content,dy_create_time,dynamic.user_id,dynamic_id,dy_pic')     //获取的字段
            ->select();
        foreach($result as $key => $value){
            $result[$key]['href'] = '/index.php/Home/Index/user_dy/user_id/'.$result[$key]['user_id'];
            $result[$key]['sm_dy_pic'] = $result[$key]['dy_pic']."?imageView2/1/w/300/h/150";
            if($year == date("Y", $result[$key]['dy_create_time'])){
                if($result[$key]['time'] < $tody){
                    $result[$key]['time'] = date("m月d日 H:i",$result[$key]['dy_create_time']);
                    
                }else{
                    $result[$key]['time'] = date("H:i",$result[$key]['dy_create_time']);
                }
            }else{
                    $result[$key]['time'] = date("Y年m月d日 H:i",$result[$key]['dy_create_time']);
            }
        }
        $this->assign('dy_info',$result);
        $this->display();
    }
    // 某人的动态
    public function person(){
        $page = I('page');
        $count = ($page-1)*10;
        $dynamic = M('dynamic');
        $user_id = I('user_id');
        $nick_name = M('user')->where(array('user_id'=>$user_id))->getField("nick_name");
        $create_time = M('user')->where(array('user_id'=>$user_id))->getField("create_time");
        $since = date("Y-m-d H:i:s",$create_time);
        $now = time();
        $tody = strtotime(date('Y-m-d', time()));
        $year = date("Y", $now);
        $result = $dynamic
            ->where(array('dynamic.user_id'=>$user_id))
            ->join('user ON dynamic.user_id = user.user_id')    //连表查询结果
            ->field('nick_name,content,dy_create_time,dynamic.user_id,dynamic_id,dy_pic')     //获取的字段
            ->order('dy_create_time desc')  //按时间排序
            ->limit($count,10)
            ->select();
        foreach($result as $key => $value){
            $result[$key]['href'] = '/index.php/Home/Index/dy_info/dynamic_id/'.$result[$key]['dynamic_id']; //在结果中添加‘href’字段
            $result[$key]['sm_dy_pic'] = C('QINIU_ENDPOINT').$result[$key]['dy_pic']."?imageView2/1/w/300/h/150";
            $result[$key]['dy_picture'] = C('QINIU_ENDPOINT').$result[$key]['dy_pic'];
            if($year == date("Y", $result[$key]['dy_create_time'])){
                if($result[$key]['time'] < $tody){
                    $result[$key]['time'] = date("m月d日 H:i",$result[$key]['dy_create_time']);
                    
                }else{
                    $result[$key]['time'] = date("H:i",$result[$key]['dy_create_time']);
                }
            }else{
                    $result[$key]['time'] = date("Y年m月d日 H:i",$result[$key]['dy_create_time']);
            }
        }
        $this->ajaxReturn(array('code'=>1,'msg'=>"获取成功",'data'=>$result,'nick_name'=>$nick_name,'since'=>$since));
    }
    // 添加动态页面
    public function add_dynamic(){
        $user_id = session('user.user_id');
        if($user_id){
            $time = time();
            $qiniu_updload_token = QiniuModel::qiniu_updload_token();
            $this->assign('qiniu_updload_token', $qiniu_updload_token);//七牛上传token
            $this->assign('time',$time);
            $this->assign('user_info',$_SESSION['user']);
        }else{
            redirect('/index.php/Home/Index/index');
        }
        $this->display();
    }
    // home列表
    public function getList(){
        if(IS_POST){
            $page = I('page');
            $dynamic = M('dynamic');
            $count = ($page-1)*10;
            $now = time();
            $tody = strtotime(date('Y-m-d', time()));
            $year = date("Y", $now);
            //连表查出来的结果
            $result = $dynamic
                ->join('user ON dynamic.user_id = user.user_id')    //连表查询结果
                ->field('nick_name,content,dy_create_time,dynamic.user_id,dynamic_id,dy_pic')     //获取的字段
                ->order('dy_create_time desc')  //按时间排序
                ->limit($count,10)
                ->select();
                foreach($result as $key => $value){
                    $result[$key]['href'] = '/index.php/Home/Index/dy_info/dynamic_id/'.$result[$key]['dynamic_id']; //在结果中添加‘href’字段
                    $result[$key]['href2'] = '/index.php/Home/Index/user_dy/user_id/'.$result[$key]['user_id'];
                    $result[$key]['sm_dy_pic'] = C('QINIU_ENDPOINT').$result[$key]['dy_pic']."?imageView2/1/w/300/h/150";
                    $result[$key]['dy_picture'] = C('QINIU_ENDPOINT').$result[$key]['dy_pic'];
                    // var_dump($result[$key]['time']);
                    if($year == date("Y", $result[$key]['dy_create_time'])){
                        if($result[$key]['time'] < $tody){
                            $result[$key]['time'] = date("m月d日 H:i",$result[$key]['dy_create_time']);
                            
                        }else{
                            $result[$key]['time'] = date("H:i",$result[$key]['dy_create_time']);
                        }
                    }else{
                            $result[$key]['time'] = date("Y年m月d日 H:i",$result[$key]['dy_create_time']);
                    }
                }
                // var_dump($result);
            $this->ajaxReturn(array('code'=>1,'msg'=>'查询成功','data'=>$result));
        }
    }
    // 注册
    public function registeredUser(){
        if(IS_POST){
            $data['nick_name'] = I('nick_name');
            $data['email'] = I('email');
            $data['password'] = md5(I('password'));
            $data['password_again'] = md5(I('password_again'));
            $data['create_time'] = time();
            $where['email'] = $data['email'];
            $userid = M('user')->where($where)->find();
            if(!empty($data['nick_name']) && !empty($data['email']) && !empty($data['password'] && $data['password']===$data['password_again'])){
                if($userid){
                    $this->ajaxReturn(array('code'=>0,'msg'=>'注册失败,你的邮箱已被使用'));
                }else{
                    M('user')->add($data);
                    $this->ajaxReturn(array('code'=>1,'msg'=>'注册成功','data'=>$data));
                }
            }else{
                    $this->ajaxReturn(array('code'=>-1,'msg'=>'你是不是填错了什么？'));
            }
        }
    }
    //登陆
    public function loginAuthentication(){
        if(IS_POST){
            $email = I('email');
            $password = md5(I('password'));
            $user_info = M('user')->where(array('email'=>$email))->field('user_id,nick_name,email')->find();
            $createTime = M('user')->where(array('email'=>$email))->getField('create_time');
            $create_time = date('Y-m-d H:i:s',$createTime);
            $checkPassword = M('user')->where(array('email'=>$email))->getField('password');
            if($checkPassword && $password == $checkPassword){
                session('user',$user_info);
                $this->ajaxReturn(array('code'=>1,'msg'=>'登陆成功','nick_name'=>$user_info['nick_name'],'create_time'=>$create_time));
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'你是不是记错了什么？'));
            }
        }
    }
    //注册验证邮箱
    public function checkEmail(){
        if(IS_POST){
            $email = I('email');
            $where['email']=$email;
            $checkEmail = M('user')->where($where)->find();
            if($checkEmail){
                $this->ajaxReturn(array('code'=>1,'msg'=>'验证成功'));
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'你是不是记错邮箱了？'));
            }
        }
        
    }
    // 修改密码
    public function changePsd(){
        if(IS_POST){
            $email = I('email');
            $data['password'] = md5(I('password'));
            $password_again = md5(I('password_again'));
            $where['email']=$email;
            if($data['password'] === $password_again){
                $resule = M('user')->where($where)->save($data);
                if($resule){
                    $this->ajaxReturn(array('code'=>1,'msg'=>'修改密码成功'));
                }else{
                    $this->ajaxReturn(array('code'=>0,'msg'=>'修改密码失败，可能服务器有点问题'));
                }
            }
        }
    }
    //发布动态
    public function release(){
        if(IS_POST){
            if(!empty($_SESSION['user']['user_id'])){
                $data['user_id'] = $_SESSION['user']['user_id'];
                $data['content'] = I('content');
                // $data['dy_pic'] = I('dy_pic');
                $data['dy_create_time'] = time();
                $result = M('dynamic')->add($data);
                if($result){
                    $this->ajaxReturn(array('code'=>1,'msg'=>'动态发布成功'));
                }else{
                    $this->ajaxReturn(array('code'=>0,'msg'=>'动态发布失败，稍后再试试？'));
                }
            }else{
                    $this->ajaxReturn(array('code'=>-1,'msg'=>'用户未登录'));
            }
            
            
        }
    }
}