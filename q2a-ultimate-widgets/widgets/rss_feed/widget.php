<?php

class rss_feed {
	
	function allow_template($template)
	{
		return true;
	}

	function allow_region($region)
	{
		return true;
	}
	
	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{
		$widget_name = get_class($this) . '_' .strtoupper(substr($region,0,1).substr($place,0,1)) ;
		$url = get_widget_option($widget_name, 'uw_url');
		$count=(int)get_widget_option($widget_name, 'uw_count');
		$title=get_widget_option($widget_name, 'uw_title');
		$nofollow = (bool)get_widget_option($widget_name, 'uw_nofollow');;
		$gzip = (bool)get_widget_option($widget_name, 'uw_gzip');;
		$get_thumbnails = (bool)get_widget_option($widget_name, 'uw_thumbnail');;

		echo '<aside class="uw-feed-widget">';
		if($title)
			echo '<H2 class="uw-feed-header">'.$title.'</H2>';

		// read live content
		$content = file_get_contents($url);
		if ($gzip)
			$content = $this->gzdecoder( $content );
		// process feed chema
		$x = new SimpleXmlElement($content);  
		echo '<ul class="uw-feed-list">'; 
		$i=0;
		$rel = '';
		if ($nofollow)
			$rel = 'rel="nofollow"';
		if($get_thumbnails){
			$thumbnail_w = (int)get_widget_option($widget_name, 'uw_thumbnail_width');;		
			$thumbnail_h = (int)get_widget_option($widget_name, 'uw_thumbnail_hight');;				
		}
		
		foreach($x->channel->item as $entry) {
			$thumbnail = '';
			if($get_thumbnails){
				$namespaces = $entry->getNameSpaces( true );
				$media = $entry->children( $namespaces['media'] );
				$thumbnail = $media->content->thumbnail->attributes()->url;
				if(! empty($thumbnail))
					$thumbnail = '<img class="uw-feed-thumbnail" src="' . $thumbnail . ($thumbnail_w > 0 ? '" width="' . $thumbnail_w . '"' : '') . ($thumbnail_h > 0 ? ' hight="' . $thumbnail_h . '"' : '') . '> ';
				else
					$thumbnail = '';
			}
			echo '<li class="uw-feed-link-body"><a href="' . $entry->link . '"" $rel title="' . $entry->title . '"" class="uw-feed-link">' . $thumbnail . '<span class="uw-feed-title">' . $entry->title . '</span></a></li>';
			$i++;
			if ($i>=$count)
				break;
		}  
		echo "</ul>";  
			
			
		echo '</aside>';
	}

	function gzdecoder($d){
		$f=ord(substr($d,3,1));
		$h=10;$e=0;
		if($f&4){
			$e=@unpack('v',substr($d,10,2));
			$e=$e[1];$h+=2+$e;
		}
		if($f&8){
			$h=@strpos($d,chr(0),$h)+1;
		}
		if($f&16){
			$h=@strpos($d,chr(0),$h)+1;
		}
		if($f&2){
			$h+=2;
		}
		$u = @gzinflate(@substr($d,$h));
		if($u===FALSE){
			$u=$d;
		}
		return $u;
	}
}
