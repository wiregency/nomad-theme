<?php

return [
    'color' => ['required', new \Azuriom\Rules\Color()],
    'footer_description' => 'required|string',
    'footer_links' => 'nullable|array',
    'legal_links' => 'nullable|array',
    'unique_players' => 'required|integer|min:0',
    'record_players' => 'required|integer|min:0',
    'cta_title' => 'required|string',
    'cta_description' => 'required|string',
    'about_image' => 'nullable|string',
    'about_title' => 'required|string',
    'about_description' => 'required|string',
    'stats_icon_1' => 'required|string',
    'stats_icon_2' => 'required|string',
    'stats_icon_3' => 'required|string',
    'unique_players_label' => 'required|string',
    'record_players_label' => 'required|string',
    'online_players_label' => 'required|string',
];
