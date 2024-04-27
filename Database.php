<?php

namespace FpDbTest;

use Exception;
use mysqli;

class Database implements DatabaseInterface
{
    private mysqli $mysqli;
    private DatabaseTemplateInterface $template;

    public function __construct(mysqli $mysqli, DatabaseTemplateInterface $template)
    {
        $this->mysqli = $mysqli;
        $this->template = $template;
    }

    public function buildQuery(string $query, array $args = []): string
    {
        if (!$args) {
            return $this->mysqli->real_escape_string($query);
        }

        $result = $this->template->compile($query, $args);

        if (!$result) {
            throw new Exception("Compile error for query: '{$query}'");
        }

        $sql = $this->mysqli->real_escape_string($result);

        return $sql;
    }


    public function skip()
    {
        return $this->template->skip();
    }
}
