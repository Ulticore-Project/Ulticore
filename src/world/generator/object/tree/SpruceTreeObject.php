<?php

/***REM_START***/
require_once("src/world/generator/object/tree/TreeObject.php");

/***REM_END***/
class SpruceTreeObject extends TreeObject{

	var $type = 1;
	private $totalHeight = 12;
	private $leavesBottomY = -1;
	private $leavesMaxRadius = -1;

	public function canPlaceObject(Level $level, Vector3 $pos, Random $random){
        $this->totalHeight += $random->nextRange(-1, 2);
        $this->leavesBottomY = (int) ($this->totalHeight - $random->nextRange(1, 2) - 3);
        $this->leavesMaxRadius = 1 + $random->nextRange(0, 1);
		$checkRadius = 0;
		for($yy = 0; $yy < $this->totalHeight + 2; ++$yy){
			if($yy === $this->leavesBottomY){
				$checkRadius = $this->leavesMaxRadius;
			}
			for($xx = -$checkRadius; $xx < ($checkRadius + 1); ++$xx){
				for($zz = -$checkRadius; $zz < ($checkRadius + 1); ++$zz){
					if(!isset($this->overridable[$level->level->getBlockID($pos->x + $xx, $pos->y + $yy, $pos->z + $zz)])){
						return false;
					}
				}
			}
		}
		return true;
	}

	public function placeObject(Level $level, Vector3 $pos, Random $random){
		if($this->leavesBottomY === -1 or $this->leavesMaxRadius === -1){
            $this->totalHeight += $random->nextRange(-1, 2);
            $this->leavesBottomY = (int) ($this->totalHeight - $random->nextRange(1, 2) - 3);
            $this->leavesMaxRadius = 1 + $random->nextRange(0, 1);
		}
		$level->setBlockRaw(new Vector3($pos->x, $pos->y - 1, $pos->z), new DirtBlock());
		$leavesRadius = 0;
		for($yy = $this->totalHeight; $yy >= $this->leavesBottomY; --$yy){
			for($xx = -$leavesRadius; $xx <= $leavesRadius; ++$xx){
				for($zz = -$leavesRadius; $zz <= $leavesRadius; ++$zz){
					if(abs($xx) != $leavesRadius or abs($zz) != $leavesRadius or $leavesRadius <= 0){
						$level->setBlockRaw(new Vector3($pos->x + $xx, $pos->y + $yy, $pos->z + $zz), new LeavesBlock($this->type));
					}
				}
			}
			if($leavesRadius > 0 and $yy === ($pos->y + $this->leavesBottomY + 1)){
				--$leavesRadius;
			}elseif($leavesRadius < $this->leavesMaxRadius){
				++$leavesRadius;
			}
		}
		for($yy = 0; $yy < ($this->totalHeight - 1); ++$yy){
			$level->setBlockRaw(new Vector3($pos->x, $pos->y + $yy, $pos->z), new WoodBlock($this->type));
		}
	}


}