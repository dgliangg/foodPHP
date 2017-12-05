<?php
/**
 * Created by PhpStorm.
 * User: D_G_liang
 * Date: 2017/12/4
 * Time: 20:15
 */
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {

    /**检测用户名密码是否正确**/
    public function checkLogin(){
        $json = $GLOBALS['HTTP_RAW_POST_DATA'];        //接收post数据！！！

        $js=json_decode($json);
        $username = $js->username;
        $password = $js->password;

        /* 0 是成功， 1是失败 */
        $return = $this->checkPassword($username, $password);

        if(!$return){
            $res['status']  = 1;
            $this->ajaxReturn($res);
        }
        else {

            $res['status'] = 0;
            $this->ajaxReturn($res);
        }
    }


    /***===检查密码是否正确===***/
    public function checkPassword($username, $password)
    {
        $map['username'] = $username;
        $user = M('user')->where($map)->find();
        if ($user['password'] === $password) {
            return $user;
        } else {
            return false;
        }
    }
    public function enroll(){

    }


    //======注册检查======//
    //注册确认
    public function checkEnroll(){
        $json = $GLOBALS['HTTP_RAW_POST_DATA'];        //接收post数据！！！

        $js=json_decode($json);
        $username = $js->username;
        $password = $js->password;
        $cpassword= $js->cpassword;
//        $username = I("username"); //接收用户名，并且使用trim函数去除首尾空格
//        $password = I("password"); //接收密码，并且使用md5函数加密
//        $cpassword = I("cpassword"); //接收确认密码密码，并且使用md5函数加密

        $reusername = $this->checkReusername($username);//判断用户名是否存在
        $repassword = $this->checkRePassword($password,$cpassword);//判断密码与确认密码

        /* 0是成功， 1是失败 */
        if(!$reusername){
            $res['user']  = 1;
            $this->ajaxReturn($res);
        }
        else
        {
            if(!$repassword)
            {
                $res['password']  = 1;
                $this->ajaxReturn($res);
            }
            else
            {
//                $request =$_SERVER['QUERY_STRING'];
//                $userenroll=M('user');
//                $data = ['username' =>'username', 'password' => $request];
                //$data=I('post.');
                //$data['password']=I("password");

                $data['username'] = $username;
                $data['password'] = $password;
                Db:name('user')->insert($data);

                $res['password'] = 0;
                $res['user'] = 0;
                $this->ajaxReturn($res);
            }
        }
    }
    public function checkReUsername($username)
    {
        //检测是否已存在账号
        $map['username'] = $username;
        $user = M('user')->where($map)->find();
        if ($user['username'] === $username)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function checkRePassword($password,$cpassword)
    {
        //检测密码与确认密码一致性
        if($password===$cpassword)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}