<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('fpdf/fpdf.php');
class Pdf extends FPDF{

    function __construct($orientation='P', $unit='mm', $size=array(210,330)){
        parent::__construct($orientation,$unit,$size);
    }

    function letak($gambar){
        //memasukkan gambar untuk header
        $this->Image($gambar,20,10,22,25);
        //menggeser posisi sekarang
    }

    function judul($teks1, $teks2, $teks3, $teks4, $teks5,$teks6,$teks7){
        $this->Cell(18);
        $this->SetFont('Arial','B','10');
        $this->Cell(0,5,$teks1,0,1,'C');
        $this->Cell(18);
        $this->Cell(0,5,$teks2,0,1,'C');
        $this->Cell(18);
        $this->SetFont('Arial','B','15');
        $this->Cell(0,5,$teks3,0,1,'C');
        $this->Cell(18);
        $this->SetFont('Arial','I','8');
        $this->Cell(0,5,$teks4,0,1,'C');
        $this->Cell(18);
        $this->Cell(0,2,$teks5,0,1,'C');
        $this->Cell(18);
        $this->SetFont('Arial','','10');
        $this->Cell(0,5,$teks6,0,1,'C');
        $this->Cell(18);
        $this->SetFont('Arial','','8');
        $this->Cell(0,2,$teks7,0,1,'C');
    }

    function garis(){
        $this->SetLineWidth(1);
        $this->Line(10,40,200,40);
    }

    // variable to store widths and aligns of cells, and line height
	var $widths;
	var $aligns;
	var $lineHeight;

	//Set the array of column widths
	function SetWidths($w){
		$this->widths=$w;
	}

	//Set the array of column alignments
	function SetAligns($a){
		$this->aligns=$a;
	}

	//Set line height
	function SetLineHeight($h){
		$this->lineHeight=$h;
	}

	//Calculate the height of the row
	function Row($data)
	{
		// number of line
		$nb=0;
		
		// loop each data to find out greatest line number in a row.
		for($i=0;$i<count($data);$i++){
			// NbLines will calculate how many lines needed to display text wrapped in specified width.
			// then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		}
		
		//multiply number of line with line height. This will be the height of current row
		$h=$this->lineHeight * $nb;
		
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		
		//Draw the cells of current row
		for($i=0;$i<count($data);$i++)
		{
			// width of the current col
			$w=$this->widths[$i];
			
			// alignment of the current col. if unset, make it left.
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			
			//Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
			
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//calculate the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}

	function getHari($tanggal){
		$hari   = date('l', microtime($tanggal));
        $hari_indonesia = array('Monday'  => 'Senin',
								'Tuesday'  => 'Selasa',
								'Wednesday' => 'Rabu',
								'Thursday' => 'Kamis',
								'Friday' => 'Jumat',
								'Saturday' => 'Sabtu',
								'Sunday' => 'Minggu');
		return $hari_indonesia[$hari];
	}

	function getBulan($bulan)
	{
	Switch ($bulan){
		case 1 : $bulan="Januari";
			Break;
		case 2 : $bulan="Februari";
			Break;
		case 3 : $bulan="Maret";
			Break;
		case 4 : $bulan="April";
			Break;
		case 5 : $bulan="Mei";
			Break;
		case 6 : $bulan="Juni";
			Break;
		case 7 : $bulan="Juli";
			Break;
		case 8 : $bulan="Agustus";
			Break;
		case 9 : $bulan="September";
			Break;
		case 10 : $bulan="Oktober";
			Break;
		case 11 : $bulan="November";
			Break;
		case 12 : $bulan="Desember";
			Break;
		}
	return $bulan;
	}
}
?>