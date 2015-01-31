<?
include 'class.pager.php';

class PagerBootstrap extends Pager {
/*
 * Prints pager controls like this:
 *    << ANTERIOR   1 2 3 4 5 6 7   SIGUIENTE >>
 */
	public function controls($number_limit=5, $class="paginador", $desc = null){
		$page = $this->page;
		$paginas = $this->page_count;
		$start = max($page - floor($number_limit/2),1);
		$end = $start - 1 + min($paginas,$number_limit);
		if($end > $paginas){
			$start = max($paginas - $number_limit + 1,1);
			$end = $start -1 + min($paginas,$number_limit);
		}
		$link = $this->link_template;
		$ret = '<ul class=" pagination">';
		if($paginas >1){
			$ret.= '<li '.($page==1?'class="disabled"':'').'><a href="'.$this->replace_template($link,$page-1).'">&laquo;</a></li>';

			if($start > 1) $ret.= '<li class="disabled"><a href="#">&hellip;</a></li>';

			for ($i=$start; $i <= $end; $i++){
				if ($page!=$i)
					if($i==$start && $first_link)
						$ret.='<li><a href="'.$this->replace_template($first_link,$i).'">'.$i.'</a></li>';
					else
						$ret.='<li><a href="'.$this->replace_template($link,$i).'">'.$i.'</a></li>';
				else
					$ret.='<li class="active"><a href="'.$this->replace_template($link,$i).'">'.$i.'</a></li>';
				if($i < $end) $ret.= "";
			}

			if($end < $paginas) $ret.= '<li class="disabled"><a href="#">&hellip;</a></li>';

			$ret.= '<li '.($page==$pagina?'class="disabled"':'').'><a href="'.$this->replace_template($link,$page+1).'">&raquo;</a></li>';
		}
		$ret.='</ul>';
		return $ret;
	}

}
