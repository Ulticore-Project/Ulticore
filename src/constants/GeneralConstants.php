<?php

const PMF_LEVEL_DEFLATE_LEVEL = 6;

//Gamemodes
const SURVIVAL = 0;
const CREATIVE = 1;
const ADVENTURE = 2;
const VIEW = 3;
const VIEWER = 3;
const SPECTATOR = 3;

//Block Sides
const SIDE_DOWN = 0;
const SIDE_UP = 1;
const SIDE_ZNEG = 2;
const SIDE_ZPOS = 3;
const SIDE_XNEG = 4;
const SIDE_XPOS = 5;

//Players
//define("MAX_CHUNK_RATE", 20 / arg("max-chunks-per-second", 16)); //Default rate ~256 kB/s
const PLAYER_MAX_QUEUE = 1024;

const PLAYER_SURVIVAL_SLOTS = 36;
const PLAYER_CREATIVE_SLOTS = 112;

//Block Updates
const BLOCK_UPDATE_NORMAL = 1;
const BLOCK_UPDATE_RANDOM = 2;
const BLOCK_UPDATE_SCHEDULED = 3;
const BLOCK_UPDATE_WEAK = 4;
const BLOCK_UPDATE_TOUCH = 5;