/**
 *
 * @package password_strength JavaScript Code
 * @version 0.0.7 6/2/11 5:23 PM
 * @copyright (c) 2011 VSE for phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @inspired by Naked Password by Platform45 at http://www.nakedpassword.com
 *
 **/
jQuery((function(t){t.fn.passwordStrength=function(){return this.each((function(){var s=[];function o(){var o=function(t){return 0+(t.length>5)+(/[a-z]/.test(t)&&/[A-Z]/.test(t))+(/\d/.test(t)&&/\D/.test(t))+(/[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/.test(t)&&/\w/.test(t))+(t.length>12)}(t(this).val());!function(o,r){o.css("background-color",s[r][0]),t("#password_strength").html(s[r][1])}(t(this),o)}s[0]=[t(this).css("background-color"),""],s[1]=[ps_color1,ps_text1],s[2]=[ps_color2,ps_text2],s[3]=[ps_color3,ps_text3],s[4]=[ps_color4,ps_text4],s[5]=[ps_color5,ps_text5],t(this).bind("keyup",o).bind("blur",o).after("<div id='password_strength'></div>")}))},t("#new_password").passwordStrength()}));