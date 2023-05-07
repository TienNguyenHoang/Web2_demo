<?php

    // include_once 'D:\XAMPP\htdocs\ThaiTranWeb2\src\main\dao\dbDAO.php';
    // include_once 'D:\XAMPP\htdocs\ThaiTranWeb2\src\main\model\accountDTO.php';
    require_once '../../../../config.php';
    require_once(ROOT.'\src\main\dao\dbDAO.php');
    require_once(ROOT.'\src\main\model\accountDTO.php');

    class accountDAO extends dbDAO {

        public function findById($id) {
            $sql = "SELECT * FROM tai_khoan WHERE id = ?";
            $result = $this->read($sql,"i",$id);
            return $result;
        }

        public function findAll() {
            $sql = "SELECT * FROM tai_khoan";
            $result = $this->read($sql);
            return $result;
        }

        public function save($accountDTO) {
            $sql = "INSERT INTO tai_khoan (ten_tk, password, email, id_nhom_quyen, status) VALUES (?,?,?,?,?)";
            $result = $this->insert($sql, "sssii", $accountDTO->getTen_tk(), $accountDTO->getPassword(), $accountDTO->getEmail(), $accountDTO->getIdNhomquyen(), $accountDTO->getStatus());
            return $result;
        }

        public function updateAccount($accountDTO) {

        }

        public function deleteAccount($id) {

        }

        public function findByUserNameAndPassword($username, $password) {
            $sql = "SELECT count(id), id, ten_tk FROM tai_khoan WHERE ten_tk = ? AND password = ? AND status!=0";
            $result = $this->read($sql, "ss", $username, $password);
            return $result;
        }

        public function findRoleByUserNameAndPassword($username, $password) {
            $sql = "SELECT nq.ten_nhom_quyen FROM tai_khoan as tk INNER JOIN nhom_quyen AS nq ON tk.id_nhom_quyen=nq.id WHERE tk.ten_tk = ? AND tk.password = ?";
            $result = $this->read($sql, "ss", $username, $password);
            return $result;
        }
    }
?>