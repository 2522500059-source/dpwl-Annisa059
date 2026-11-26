
<?php
class LoginPlg_M extends Model
{
    public function DataPlg($email)
    {
        $email = $this->db->real_escape_string($email);

        $query = $this->db->query(
            "SELECT * FROM penyewa WHERE user_plg059 = '$email'"
        );

        if ($query) {
            return $query->fetch_assoc();
        }

        return null;
    }
}
