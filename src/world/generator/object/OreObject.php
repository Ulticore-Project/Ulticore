<?php

class OreObject{

	public $type;
	private $random;

	public function __construct(Random $random, OreType $type){
		$this->type = $type;
		$this->random = $random;
	}

	public function getType(){
		return $this->type;
	}

	public function canPlaceObject(Level $level, $x, $y, $z){
		return ($level->level->getBlockID($x, $y, $z) != AIR);
	}

	public function placeObject(Level $level, Vector3 $pos){
		$clusterSize = $this->type->clusterSize * 1.25;
		$angle = $this->random->nextFloat() * M_PI;
		$offset = VectorMath::getDirection2D($angle)->multiply($clusterSize)->divide(8);
		$x1 = $pos->x + 8 + $offset->x;
		$x2 = $pos->x + 8 - $offset->x;
		$z1 = $pos->z + 8 + $offset->y;
		$z2 = $pos->z + 8 - $offset->y;
		$y1 = $pos->y + $this->random->nextRange(0, 3) + 2;
		$y2 = $pos->y + $this->random->nextRange(0, 3) + 2;
		for($count = 0; $count <= $clusterSize; ++$count){
			$seedX = $x1 + ($x2 - $x1) * $count / $clusterSize;
			$seedY = $y1 + ($y2 - $y1) * $count / $clusterSize;
			$seedZ = $z1 + ($z2 - $z1) * $count / $clusterSize;
			$size = ((sin($count * (M_PI / $clusterSize)) + 1) * $this->random->nextFloat() * $clusterSize / 16 + 1) / 2;

			$startX = (int) ($seedX - $size);
			$startY = (int) ($seedY - $size);
			$startZ = (int) ($seedZ - $size);
			$endX = (int) ($seedX + $size);
			$endY = (int) ($seedY + $size);
			$endZ = (int) ($seedZ + $size);

			for($x = $startX; $x <= $endX; ++$x){
				$sizeX = ($x + 0.5 - $seedX) / $size;
				$sizeX *= $sizeX;
				if($sizeX < 1){
					for($y = $startY; $y <= $endY; ++$y){
						$sizeY = ($y + 0.5 - $seedY) / $size;
						$sizeY *= $sizeY;
						if($y > 0 and ($sizeX + $sizeY) < 1){
							for($z = $startZ; $z <= $endZ; ++$z){
								$sizeZ = ($z + 0.5 - $seedZ) / $size;
								$sizeZ *= $sizeZ;
								if(($sizeX + $sizeY + $sizeZ) < 1 and $level->level->getBlockID($x, $y, $z) === STONE){
									$level->setBlockRaw(new Vector3($x, $y, $z), $this->type->material);
								}
							}
						}
					}
				}
			}
		}
	}

}
