<?php

//Entities
const ENTITY_PLAYER = 1;

const ENTITY_MOB = 2;
const MOB_CHICKEN = 10;
const MOB_COW = 11;
const MOB_PIG = 12;
const MOB_SHEEP = 13;

const MOB_ZOMBIE = 32;
const MOB_CREEPER = 33;
const MOB_SKELETON = 34;
const MOB_SPIDER = 35;
const MOB_PIGMAN = 36;

const ENTITY_OBJECT = 3;
const OBJECT_TRIPOD_CAMERA = 62;
const OBJECT_PRIMEDTNT = 65;
const OBJECT_ARROW = 80;
const OBJECT_SNOWBALL = 81;
const OBJECT_EGG = 82;
const OBJECT_PAINTING = 83;
const OBJECT_MINECART = 84;

const ENTITY_ITEM = 4;
const ENTITY_ITEM_TYPE = 64;

const ENTITY_FALLING = 5;
const FALLING_SAND = 66;
	
//TileEntities
const TILE_SIGN = "Sign";
const TILE_CHEST = "Chest";
const CHEST_SLOTS = 27;
const TILE_FURNACE = "Furnace";
const FURNACE_SLOTS = 3;

const CORRECT_ENTITY_CLASSES = [
	ENTITY_PLAYER => true,
	ENTITY_MOB => [
		MOB_CHICKEN => true,
		MOB_COW => true,
		MOB_PIG => true,
		MOB_SHEEP => true,
			
		MOB_ZOMBIE => true,
		MOB_SKELETON => true,
		MOB_SPIDER => true,
		MOB_CREEPER => true,
		MOB_PIGMAN => true
	],
	ENTITY_OBJECT => [
		OBJECT_TRIPOD_CAMERA => true,
		OBJECT_PRIMEDTNT => true,
		OBJECT_ARROW => true,
		OBJECT_SNOWBALL => true,
		OBJECT_EGG => true,
		OBJECT_PAINTING => true,
		OBJECT_MINECART => true,
	],
	ENTITY_ITEM => true,
	ENTITY_FALLING => [
		FALLING_SAND => true
	]
	
];
