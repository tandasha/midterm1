<?php
    function query($query) {
        global $mysqli;

        $result = $mysqli->query($query);

        if ($mysqli->errno || !$result) {
            die("Query Failed: " . $mysqli->error);
        }

        return $result;
    }

    function uniqueRandomCode() {
        $symbols = 'qwertyuopiasdzcvxnzlkkfmhnioppaomjewlokevramuveqvweVENSAUCIEHWQVUIRBQTRENTQECVDASFCDA';

        do {
            $code = '';
            for ($i = 0; $i < 6; $i++) {
                $code .= $symbols[rand(0, strlen($symbols) - 1)];
            }

        } while (count(select("SELECT * FROM books WHERE code = '$code'")));

        return $code;
    }

    function select($query) {
        $result = query($query);
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    function selectBooks() {
        return select("SELECT * FROM books");
    }

    function selectBook($id) {
        $books = select("SELECT * FROM books WHERE id = '$id'");

        return count($books) ? $books[0] : null;
    }

    function insert($name, $pageNumber, $bookReleaseDate, $price, $author) {
        $code = uniqueRandomCode();

        query("INSERT INTO books (name, page_number, release_date, price, author, code) VALUES('$name', '$pageNumber', '$bookReleaseDate', '$price', '$author', '$code')");
    }

    function update($id, $name, $pageNumber, $bookReleaseDate, $price, $author) {
        query("UPDATE books (name, page_number, release_date, price, author) VALUES('$name', '$pageNumber', '$bookReleaseDate', '$price', '$author') WHERE id = '$id'");
    }

    function delete($id) {
        query("DELETE FROM books WHERE id = '$id'");
    }

    function siteUrl($url) {
        return SITE_PREFIX . $url;
    }

    function redirect($location) {
        if (strpos($location, 'http') !== 0) {
            $location = SITE_PREFIX . trim($location, '/');
        }

        header("Location: $location");
        exit;
    }

    function back() {
        redirect($_SERVER['HTTP_REFERER']);
    }
