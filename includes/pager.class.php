<?php

 class Pager 
 { 
  /*********************************************************************************** 
   * int findStart (int limit) 
   * Returns the start offset based on $_GET['page'] and $limit 
   ***********************************************************************************/ 
   function findStart($limit) 
   { 
		 if ((!$_REQUEST['page']) || ($_REQUEST['page'] == "1")) 
		 { 
		   $start = 0; 
		   $_REQUEST['page'] = 1; 
		 } 
		 else 
		 { 
			$start = ($_REQUEST['page']-1) * $limit;  
		 } 

     	return $start; 
   } 
  /*********************************************************************************** 
   * int findPages (int count, int limit) 
   * Returns the number of pages needed based on a count and a limit 
   ***********************************************************************************/ 
	   function findPages($count, $limit) 
	   { 
		 
		 $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1; 
		 return $pages; 
	   } 
	   
  
 	
	function pageString($TotalPages , $crrentPage , $link , $range=10)
	{
		
		if ($TotalPages > 1 ) {
            $range =10;
            $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
            $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
            $page_min = $crrentPage- $range_min;
            $page_max = $crrentPage+ $range_max;

            $page_min = ($page_min < 1) ? 1 : $page_min;
            $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
            if ($page_max > $TotalPages) {
                $page_min = ($page_min > 1) ? $TotalPages - $range + 1 : 1;
                $page_max = $TotalPages;
            }

            $page_min = ($page_min < 1) ? 1 : $page_min;

            //$page_content .= '<p class="menuPage">';

            if ( ($crrentPage > ($range - $range_min)) && ($TotalPages > $range) ) {
                $page_pagination .= '<li><a class="veradana11green"  title="First" href="'.$link.'page=1">&lt;</a> </li>';
            }

            if ($crrentPage != 1) {
                $page_pagination .= '<li><a class="veradana11green" href="'.$link.'page='.($crrentPage-1). '">Previous</a></li> ';
            }

            for ($i = $page_min;$i <= $page_max;$i++) {
                if ($i == $crrentPage)
                $page_pagination .= '<li class="active"><span >' . $i . '</span></li> ';
                else
                $page_pagination.= '<li><a class="veradana11grey" href="'.$link.'page='.$i. '">'.$i.'</a></li> ';
            }

            if ($crrentPage < $TotalPages) {
                $page_pagination.= ' <li><a class="veradana11green" href="'.$link.'page='.($crrentPage + 1) . '">Next</a></li>';
            }


            if (($crrentPage< ($TotalPages - $range_max)) && ($TotalPages > $range)) {
                $page_pagination .= ' <a class="veradana11green" title="Last" href="'.$link.'page='.$TotalPages. '">&gt;</a> ';
            }
             $page['PAGINATION'] ='<p id="pagination">'.$page_pagination.'</p>';
        }//end if more than 1 page 
		return  $page_pagination; 
	
	
	}
	
	function pageStringAjax($TotalPages , $crrentPage , $link , $jsFunction ,$range=10)
	{
		
		
		if ($TotalPages > 1 ) {
            $range =10;
            $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
            $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
            $page_min = $crrentPage- $range_min;
            $page_max = $crrentPage+ $range_max;

            $page_min = ($page_min < 1) ? 1 : $page_min;
            $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
            if ($page_max > $TotalPages) {
                $page_min = ($page_min > 1) ? $TotalPages - $range + 1 : 1;
                $page_max = $TotalPages;
            }

            $page_min = ($page_min < 1) ? 1 : $page_min;

            //$page_content .= '<p class="menuPage">';

            if ( ($crrentPage > ($range - $range_min)) && ($TotalPages > $range) ) {
                $page_pagination .= '<a class="pagingNext"  title="First" href="javascript:setPage(\''.$link.'page=1\'),'.$jsFunction.'">&lt;</a> ';
            }

            if ($crrentPage != 1) {
                $page_pagination .= '<a class="pagingNext" href="javascript:setPage(\''.$link.'page='.($crrentPage-1). '\'),'.$jsFunction.'">Previous</a> ';
            }

            for ($i = $page_min;$i <= $page_max;$i++) {
                if ($i == $crrentPage)
                $page_pagination .= '<span class="pagingActive">' . $i . '</span> ';
                else
                $page_pagination.= '<a class="pagingInActive" href="javascript:setPage(\''.$link.'page='.$i. '\'),'.$jsFunction.'">'.$i.'</a> ';
            }

            if ($crrentPage < $TotalPages) {
                $page_pagination.= ' <a class="pagingNext" href="javascript:setPage(\''.$link.'page='.($crrentPage + 1) . '\'),'.$jsFunction.'">Next</a>';
            }


            if (($crrentPage< ($TotalPages - $range_max)) && ($TotalPages > $range)) {
                $page_pagination .= ' <a class="pagingNext" title="Last" href="javascript:setPage(\''.$link.'page='.$TotalPages. '\'),'.$jsFunction.'">&gt;</a> ';
            }
             $page['PAGINATION'] ='<p id="pagination">'.$page_pagination.'</p>';
        }//end if more than 1 page 
		return  $page_pagination; 
	
	
	}
 
 
 } 
?>