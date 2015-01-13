HTML::macro('tablo', function($alanlar = array(), $data = array(), $duzenlenecek = array(), $digerBolumler = array(), $adres, $duzenle = true, $sil = true, $goster = true){
	$tablo = '<table class="table table-hover table-dynamic table-tools">';
	$tablo .= '<thead>';
	$tablo .= '<tr>';

	foreach($alanlar as $alan){
		$tablo .= '<th> '. (array_key_exists($alan, $duzenlenecek) ? $duzenlenecek[$alan] : Str::title($alan)) . '</th>';
	} 
	
	if ($duzenle || $sil || $goster)
		$tablo .= '<th> İşlemler </th>';

	$tablo .= '</tr></thead>';

	$tablo .= '<tbody>';
	foreach($data as $d){
		$tablo .= '<tr>';
		foreach($alanlar as $key){
			if (array_key_exists($key, $digerBolumler)){
				if ($digerBolumler[$key] == "count"){
					$tablo .= '<td>' . count($d->$key) .'</td>';
				}
				else{
					$tablo .= '<td>' . $d->$key .'</td>';
				}
			}else{
				$tablo .= '<td>' . $d->$key .'</td>';
			}
		}
	
		if ($duzenle || $sil || $goster){
			$tablo .= '<td class="hidden-200">';
			if ($duzenle)
				$tablo .= '<a class="edit btn btn-dark" href="'.URL::route($adres,$d->id) .'/duzenle"><i class="fa fa-pencil-square-o"></i>Düzenle</a>';
			if ($sil)
				$tablo .= '<a class="delete btn btn-danger" href="'.URL::route($adres,$d->id) .'/sil"><i class="fa fa-times-circle"></i>Sil</a>';
			if ($goster)
				$tablo .= '<a class="edit btn btn-primary" href="'.$adres.'/'.$d->id.'/detay"><i class="fa fa-times-circle"></i>Detay</a>';
			$tablo .= '</td>';
		}
		$tablo .= '</tr>';
	}
	$tablo .= '</tbody>';
	$tablo .= '</table>';

	return $tablo;

});