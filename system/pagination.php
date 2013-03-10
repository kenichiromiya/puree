<?php
class Pagination
{
    public function __construct() {
    }

    function getpagination($param) {
        $page = $param['page'];
        $per_page = $param['per_page'];
        $total = $param['total'];
        $page = isset($page) ? $page : '1';
        $min_page = 1;
        $max_page = ceil($total/$per_page);
        $pages = array($page);
        $offset = 1;
        while ($i < 5 and (($page - $offset > 0) or ($page + $offset <= $max_page))) {
            if ($page - $offset > 0 ){
                array_unshift($pages,$page - $offset);
                $i++;
            }
            if ($page + $offset <= $max_page ){
                array_push($pages,$page + $offset);
                $i++;
            }
            $offset++;
        }
        $pagination['page'] = $page;
        $pagination['pages'] = $pages;

        $pagination['min_page'] = 1;
        if($page > $min_page){
            $pagination['prev_page'] = $page-1;
        }
        if($page < $max_page){
            $pagination['next_page'] = $page+1;
        }
        $pagination['max_page'] = $max_page;
        return $pagination;
    }
}
?>
