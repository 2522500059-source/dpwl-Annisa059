<?php
class Login_M extends Model
{
    function ambildata($email)
    {
        $dtadmin = $this->db->prepare("select username, password, status_akun
            from admin where username=? and status_akun='Aktif'");
        $dtadmin->bind_param("s", $email);
        $dtadmin->execute();
        return $dtadmin->get_result()->fetch_assoc();
    }
}