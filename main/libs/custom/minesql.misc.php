<?php

//Only HTML escaping - Do not use with any other fragile enviroment
sanitize_html($data) {
	return htmlentities(strip_tags($data));
}
