<?php
/**
 * HSDN Weather-Display Parser
 *
 * @version		1.34.2b
 * @author		HSDN Team
 * @copyright	Copyright (c) 2015, Information Networks Ltd.
 * @link		http://www.hsdn.org
 *
 * @compat		with Weather-Display ver. 10.37R build 296
 */
class WeatherDisplay
{
	/*
	 * Station locale set (language) for dates
	 */
	public static $locale = 'ru_RU';


	// --------------------------------------------------------------------
	// Data fields
	// --------------------------------------------------------------------

	/*
	 * Fields for parse file "clientraw.txt"
	 */
	private $clientraw_fields = array
	(
		'header'						=> array(0, 1),
		'average_wind_speed'			=> array(0, 1),
		'gust_speed'					=> array(0, 1),
		'wind_direction'				=> array(0, 1),
		'temperature'					=> array(0, 1),
		'humidity'						=> array(0, 1),
		'barometer'						=> array(0, 1),
		'day_rain'						=> array(0, 1),
		'month_rain'					=> array(0, 1),
		'year_rain'						=> array(0, 1),
		'rain_rate'						=> array(0, 1),
		'rain_rate_max'					=> array(0, 1),
		'indoor_temperature'			=> array(0, 1),
		'indoor_humidity'				=> array(0, 1),
		'soil_temperature'				=> array(0, 1),
		'forecast_icon'					=> array(0, 1),
		'wmr968_extra_temperature'		=> array(0, 1),
		'wmr968_extra_humidity'			=> array(0, 1),
		'wmr968_extra_sensor'			=> array(0, 1),
		'yesterday_rain'				=> array(0, 1),
		'extra_temp_sensor_1'			=> array(0, 1),
		'extra_temp_sensor_2'			=> array(0, 1),
		'extra_temp_sensor_3'			=> array(0, 1),
		'extra_temp_sensor_4'			=> array(0, 1),
		'extra_temp_sensor_5'			=> array(0, 1),
		'extra_temp_sensor_6'			=> array(0, 1),
		'extra_hum_sensor_1'			=> array(0, 1),
		'extra_hum_sensor_2'			=> array(0, 1),
		'extra_hum_sensor_3'			=> array(0, 1),
		'hour'							=> array(0, 1),
		'minute'						=> array(0, 1),
		'seconds'						=> array(0, 1),
		'station_name'					=> array(0, 1),
		'dallas_lighting_count'			=> array(0, 1),
		'solar_reading'					=> array(0, 1),
		'day'							=> array(0, 1),
		'month'							=> array(0, 1),
		'wmr968_batt_1'					=> array(0, 1),
		'wmr968_batt_2'					=> array(0, 1),
		'wmr968_batt_3'					=> array(0, 1),
		'wmr968_batt_4'					=> array(0, 1),
		'wmr968_batt_5'					=> array(0, 1),
		'wmr968_batt_6'					=> array(0, 1),
		'wmr968_batt_7'					=> array(0, 1),
		'wind_chill'					=> array(0, 1),
		'humidity_index'				=> array(0, 1),
		'day_temperature_max'			=> array(0, 1),
		'day_temperature_min'			=> array(0, 1),
		'icon_type'						=> array(0, 1),
		'weather_description'			=> array(0, 1),
		'barometer_trend'				=> array(0, 1),
		'20_hours_wind_speed'			=> array(0, 20),
		'day_gust_speed_max'			=> array(0, 1),
		'dewpoint_temperature'			=> array(0, 1),
		'cloud_height'					=> array(0, 1),
		'date'							=> array(0, 1),
		'humidity_index_max'			=> array(0, 1),
		'humidity_index_min'			=> array(0, 1),
		'wind_chill_max'				=> array(0, 1),
		'wind_chill_min'				=> array(0, 1),
		'davis_vp_uv'					=> array(0, 1),
		'hr_wind_speed'					=> array(0, 10),
		'hr_temperature'				=> array(0, 10),
		'hr_rain'						=> array(0, 10),
		'heat_index_max'				=> array(0, 1),
		'heat_index_min'				=> array(0, 1),
		'heat_index'					=> array(0, 1),
		'average_wind_speed_max'		=> array(0, 1),
		'last_minute_lightning'			=> array(0, 1),
		'last_lightning_strike_time'	=> array(0, 1),
		'last_lightning_strike_date'	=> array(0, 1),
		'wind_average_direction'		=> array(0, 1),
		'nexstorm_dist'					=> array(0, 1),
		'nexstorm_bearing'				=> array(0, 1),
		'extra_temp_sensor_7'			=> array(0, 1),
		'extra_temp_sensor_8'			=> array(0, 1),
		'extra_hum_sensor_4'			=> array(0, 1),
		'extra_hum_sensor_5'			=> array(0, 1),
		'extra_hum_sensor_6'			=> array(0, 1),
		'extra_hum_sensor_7'			=> array(0, 1),
		'extra_hum_sensor_8'			=> array(0, 1),
		'vp_solarwm'					=> array(0, 1),
		'max_intemp'					=> array(0, 1),
		'min_intemp'					=> array(0, 1),
		'apparent_temperature'			=> array(0, 1),
		'barometer_max'					=> array(0, 1),
		'barometer_min'					=> array(0, 1),
		'gust_speed_last_hour_max'		=> array(0, 1),
		'gust_speed_last_hour_max_time'	=> array(0, 1),
		'gust_speed_today_max_time'		=> array(0, 1),
		'apparent_temperature_max'		=> array(0, 1),
		'apparent_temperature_min'		=> array(0, 1),
		'dew_pt_max'					=> array(0, 1),
		'dew_pt_min'					=> array(0, 1),
		'gust_speed_in_l_minute_max'	=> array(0, 1),
		'year'							=> array(0, 1),
		'thsws'							=> array(0, 1),
		'temperature_trend'				=> array(0, 1),
		'humidity_trend'				=> array(0, 1),
		'humidity_index_trend'			=> array(0, 1),
		'hr_wind_direction'				=> array(0, 10),
		'leaf_wetness'					=> array(0, 1),
		'soil_moisture'					=> array(0, 1),
		'10_minutes_average_wind_speed'	=> array(0, 1),
		'wet_bulb_temperature'			=> array(0, 1),
		'latitude'						=> array(0, 1),
		'longitude'						=> array(0, 1),
		'9am_rain_reset_total'			=> array(0, 1),
		'day_humidity_max'				=> array(0, 1),
		'day_humidity_min'				=> array(0, 1),
		'midnight_reset_rain_total'		=> array(0, 1),
		'windchill_min_time'			=> array(0, 1),
		'cost_channel_1'				=> array(0, 1),
		'cost_channel_2'				=> array(0, 1),
		'cost_channel_3'				=> array(0, 1),
		'cost_channel_4'				=> array(0, 1),
		'cost_channel_5'				=> array(0, 1),
		'cost_channel_6'				=> array(0, 1),
		'day_wind_run'					=> array(0, 1),
		'day_temperature_max_time'		=> array(0, 1),
		'day_temperature_min_time'		=> array(0, 1),
	);

	/*
	 * Fields for parse file "clientrawextra.txt"
	 */
	private $clientrawextra_fields = array
	(
		'header'						=> array(0, 1),
		'20_hours_wind_speed'			=> array(0, 20),
		'20_hours_temperature'			=> array(0, 20),
		'20_hours_rain'					=> array(0, 20),

		// Records (value, hour, minute, day, month, year)
		// month
		'record_month_temperature_max'	=> array(0, 6),
		'record_month_temperature_min'	=> array(0, 6),
		'record_month_high_gust_speed'	=> array(0, 6),
		'record_month_rain_rate'		=> array(0, 6),
		'record_month_barometer_min'	=> array(0, 6),
		'record_month_barometer_max'	=> array(0, 6),
		'record_month_daily_rain'		=> array(0, 6),
		'record_month_rain_1_hour'		=> array(0, 6),
		'record_month_average_wind_speed'	=> array(0, 6),
		'record_month_soil_max'			=> array(6, 6), // previous 6 lines - reserved
		'record_month_soil_min'			=> array(0, 6),
		'record_month_wind_chill_min'	=> array(0, 6),
		'record_month_gust_direction_max'	=> array(0, 6),
		'record_month_average_wind_speed_direction'	=> array(0, 6),
		'record_month_warmest_day'		=> array(0, 6),
		'record_month_coldest_night'	=> array(0, 6),
		'record_month_coldest_day'		=> array(0, 6),
		'record_month_warmest_night'	=> array(0, 6),
		'record_month_heat_index_max'	=> array(0, 6),
		'record_month_grass_max'		=> array(0, 6),
		// year
		'record_year_temperature_max'	=> array(0, 6),
		'record_year_temperature_min'	=> array(0, 6),
		'record_year_high_gust_speed'	=> array(0, 6),
		'record_year_rain_rate'			=> array(0, 6),
		'record_year_barometer_min'		=> array(0, 6),
		'record_year_barometer_max'		=> array(0, 6),
		'record_year_daily_rain'		=> array(0, 6),
		'record_year_rain_1_hour'		=> array(0, 6),
		'record_year_average_wind_speed'	=> array(0, 6),
		'record_year_soil_max'			=> array(6, 6), // previous 6 lines - reserved
		'record_year_soil_min'			=> array(0, 6),
		'record_year_wind_chill_min'	=> array(0, 6),
		'record_year_gust_direction_max'	=> array(0, 6),
		'record_year_average_wind_speed_direction'	=> array(0, 6),
		'record_year_warmest_day'		=> array(0, 6),
		'record_year_coldest_night'		=> array(0, 6),
		'record_year_coldest_day'		=> array(0, 6),
		'record_year_warmest_night'		=> array(0, 6),
		'record_year_heat_index_max'	=> array(0, 6),
		'record_year_grass_max'			=> array(0, 6),
		// all time
		'record_alltime_temperature_max'	=> array(0, 6),
		'record_alltime_temperature_min'	=> array(0, 6),
		'record_alltime_high_gust_speed'	=> array(0, 6),
		'record_alltime_rain_rate'			=> array(0, 6),
		'record_alltime_barometer_min'		=> array(0, 6),
		'record_alltime_barometer_max'		=> array(0, 6),
		'record_alltime_daily_rain'		=> array(0, 6),
		'record_alltime_rain_1_hour'	=> array(0, 6),
		'record_alltime_average_wind_speed'		=> array(0, 6),
		'record_alltime_soil_max'		=> array(6, 6), // previous 6 lines - reserved
		'record_alltime_soil_min'		=> array(0, 6),
		'record_alltime_wind_chill_min'		=> array(0, 6),
		'record_alltime_gust_direction_max'	=> array(0, 6),
		'record_alltime_average_wind_speed_direction'	=> array(0, 6),
		'record_alltime_warmest_day'	=> array(0, 6),
		'record_alltime_coldest_night'	=> array(0, 6),
		'record_alltime_coldest_day'	=> array(0, 6),
		'record_alltime_warmest_night'	=> array(0, 6),
		'record_alltime_heat_index_max'	=> array(0, 6),
		'record_alltime_grass_max'		=> array(0, 6),

		'20_hours_barometer'			=> array(0, 20),
		'20_hours_timestamp'			=> array(0, 20),
		'snow_for_the_day'				=> array(0, 1),
		'snow_for_the_month'			=> array(0, 1),
		'snow_for_the_season'			=> array(0, 1),
		'days_since_last_rain'			=> array(0, 1),
		'days_of_rain_this_month'		=> array(0, 1),
		'7_days_rain'					=> array(0, 7),
		'20_hours_solar_reading'		=> array(0, 20),
		'20_hours_uv_reading'			=> array(0, 20),
		'davis_vp_forecast_text'		=> array(0, 1),
		'et_value'						=> array(0, 1),
		'vpp_et_value'					=> array(0, 1),
		'yesterday_rain'				=> array(0, 1),
		'wd_version'					=> array(0, 1),
		'20_hours_wind_direction'		=> array(0, 20),
		'sunrise'						=> array(0, 1),
		'sunset'						=> array(0, 1),
		'moonrise'						=> array(0, 1),
		'moonset'						=> array(0, 1),
		'moon_phase'					=> array(0, 1),
		'moon_age'						=> array(0, 1),
		'24_hours_wind_speed'			=> array(0, 4, '20_hours_wind_speed'),
		'24_hours_temperature'			=> array(0, 4, '20_hours_temperature'),
		'24_hours_rain'					=> array(0, 4, '20_hours_rain'),
		'24_hours_barometer'			=> array(0, 4, '20_hours_barometer'),
		'24_hours_timestamp'			=> array(0, 4, '20_hours_timestamp'),
		'24_hours_solar_reading'		=> array(0, 4, '20_hours_solar_reading'),
		'24_hours_uv_reading'			=> array(0, 4, '20_hours_uv_reading'),
		'24_hours_wind_direction'		=> array(0, 4, '20_hours_wind_direction'),
		'extra_temp_sensor_1_max'		=> array(0, 1),
		'extra_temp_sensor_1_min'		=> array(0, 1),
		'extra_temp_sensor_2_max'		=> array(0, 1),
		'extra_temp_sensor_2_min'		=> array(0, 1),
		'extra_temp_sensor_3_max'		=> array(0, 1),
		'extra_temp_sensor_3_min'		=> array(0, 1),
		'extra_temp_sensor_4_max'		=> array(0, 1),
		'extra_temp_sensor_4_min'		=> array(0, 1),
		'extra_temp_sensor_5_max'		=> array(0, 1),
		'extra_temp_sensor_5_min'		=> array(0, 1),
		'extra_temp_sensor_6_max'		=> array(0, 1),
		'extra_temp_sensor_6_min'		=> array(0, 1),
		'extra_temp_sensor_7_max'		=> array(0, 1),
		'extra_temp_sensor_7_min'		=> array(0, 1),
		'extra_temp_sensor_8_max'		=> array(0, 1),
		'extra_temp_sensor_8_min'		=> array(0, 1),
		'day_night_flag'				=> array(0, 1),
		'24_hours_humidity'				=> array(0, 24),
		'fwi_value'						=> array(0, 1),
		'24_hours_indoor_temperature'	=> array(0, 24),

		// Records (value, hour, minute, day, month, year)
		'record_month_solar_max'		=> array(0, 6),
		'record_month_uv_max'			=> array(0, 6),
		'record_year_solar_max'			=> array(0, 6),
		'record_year_uv_max'			=> array(0, 6),
		'record_alltime_solar_max'		=> array(0, 6),
		'record_alltime_uv_max'			=> array(0, 6),

		'sunshine_hours'				=> array(0, 1),
		'snow_depth'					=> array(0, 1),
		'hour'							=> array(0, 1),
		'minute'						=> array(0, 1),
		'seconds'						=> array(0, 1),
		'flag_solar_data'				=> array(0, 1),
		'flag_uv_data'					=> array(0, 1),
		'flag_soil_temperature_data'	=> array(0, 1),
		'24_hours_lightning'			=> array(0, 24),
		'wdl_weather_warn_flag'			=> array(0, 1),

		// Records (value, hour, minute, day, month, year)
		'record_month_dew_max'			=> array(0, 6),
		'record_month_dew_min'			=> array(0, 6),
		'record_year_dew_max'			=> array(0, 6),
		'record_year_dew_min'			=> array(0, 6),
		'record_alltime_dew_max'		=> array(0, 6),
		'record_alltime_dew_min'		=> array(0, 6),

		'chandler_burning_index'		=> array(0, 1),
		'visibility'					=> array(0, 1),
		'yesterday_temperature_max'		=> array(0, 1),
		'yesterday_temperature_min'		=> array(0, 1),
		'yesterday_temperature_max_time'	=> array(0, 1),
		'yesterday_temperature_min_time'	=> array(0, 1),
		'yesterday_barometer_max'		=> array(0, 1),
		'yesterday_barometer_min'		=> array(0, 1),
		'yesterday_barometer_max_time'	=> array(0, 1),
		'yesterday_barometer_min_time'	=> array(0, 1),
		'yesterday_max_hum'				=> array(0, 1),
		'yesterday_min_hum'				=> array(0, 1),
		'yesterday_max_hum_time'		=> array(0, 1),
		'yesterday_min_hum_time'		=> array(0, 1),
		'yesterday_gust_speed_max'		=> array(0, 1),
		'yesterday_gust_speed_max_time'	=> array(0, 1),
		'yesterday_average_max'			=> array(0, 1),
		'yesterday_average_max_time'	=> array(0, 1),
		'yesterday_wind_chill_min'		=> array(0, 1),
		'yesterday_wind_chill_min_time'	=> array(0, 1),
		'yesterday_max_heat'			=> array(0, 1),
		'yesterday_max_heat_time'		=> array(0, 1),
		'yesterday_dew_max'				=> array(0, 1),
		'yesterday_dew_min'				=> array(0, 1),
		'yesterday_dew_max_time'		=> array(0, 1),
		'yesterday_dew_min_time'		=> array(0, 1),
		'yesterday_solar_max'			=> array(0, 1),
		'yesterday_solar_max_time'		=> array(0, 1),
		'today_temperature_max'		=> array(0, 1),
		'today_temperature_min'			=> array(0, 1),
		'today_temperature_max_time'	=> array(0, 1),
		'today_temperature_min_time'	=> array(0, 1),
		'today_barometer_max'			=> array(0, 1),
		'today_barometer_min'			=> array(0, 1),
		'today_barometer_max_time'		=> array(0, 1),
		'today_barometer_min_time'		=> array(0, 1),
		'today_max_hum'					=> array(0, 1),
		'today_min_hum'					=> array(0, 1),
		'today_max_hum_time'			=> array(0, 1),
		'today_min_hum_time'			=> array(0, 1),
		'today_gust_speed_max'			=> array(0, 1),
		'today_gust_speed_max_time'		=> array(0, 1),
		'today_average_max'				=> array(0, 1),
		'today_average_max_time'		=> array(0, 1),
		'today_wind_chill_min'			=> array(0, 1),
		'today_wind_chill_min_time'		=> array(0, 1),
		'today_max_heat'				=> array(0, 1),
		'today_max_heat_time'			=> array(0, 1),
		'today_dew_max'					=> array(0, 1),
		'today_dew_min'					=> array(0, 1),
		'today_dew_max_time'			=> array(0, 1),
		'today_dew_min_time'			=> array(0, 1),
		'today_solar_max'				=> array(0, 1),
		'today_solar_max_time'			=> array(0, 1),
	);

	/*
	 * Fields for parse file "clientrawhour.txt"
	 */
	private $clientrawhour_fields = array
	(
		'header'						=> array(0, 1),
		'wind_speed'					=> array(0, 60),
		'gust_speed'					=> array(0, 60),
		'wind_direction'				=> array(0, 60),
		'temperature'					=> array(0, 60),
		'humidity'						=> array(0, 60),
		'barometer'						=> array(0, 60),
		'rain_total'					=> array(0, 60),
		'minutes_solar_data'			=> array(0, 60),
		'hours_solar_data'				=> array(0, 95),
		'hours_uv_data'					=> array(0, 95),
	);

	/*
	 * Fields for parse file "clientrawdaily.txt"
	 */
	private $clientrawdaily_fields = array
	(
		'header'						=> array(0, 1),
		'day_temperature_max'			=> array(0, 31),
		'day_temperature_min'			=> array(0, 31),
		'month_rain_month'				=> array(0, 31),
		'month_barometer'				=> array(0, 31),
		'month_wind_speed'				=> array(0, 31),
		'month_wind_direction'			=> array(0, 31),
		'12_months_rain_total'			=> array(0, 12),
		'month_humdity'					=> array(0, 31),
		'hour'							=> array(0, 1),
		'minute'						=> array(0, 1),
		'seconds'						=> array(0, 1),
		'7_days_temperature'			=> array(0, 28),
		'7_days_barometer'				=> array(0, 28),
		'7_days_humidity'				=> array(0, 28),
		'7_days_wind_direction'			=> array(0, 28),
		'7_days_wind_speed'				=> array(0, 28),
		'7_days_solar'					=> array(0, 28),
		'7_days_uv'						=> array(0, 28),
		'year_rain_total'				=> array(0, 1),
		'rain_average'					=> array(0, 12),
		'7_days_indoor_temperature'		=> array(0, 28), // optional
	);

	/*
	 * Fields for parse file "wdfulldata.xml"
	 */
	private $wdfulldata_fields = array
	(
		'time'							=> 'time',
		'date'							=> 'date',
		'minute'						=> 'time-minute',
		'hour'							=> 'time-hour',
		'day'							=> 'date-day',
		'month'							=> 'date-month',
		'year'							=> 'date-year',
		'windows_uptime'				=> 'windowsuptime',
		'next_update_time'				=> 'timeofnextupdate',
		'wd_start_time'					=> 'Startimedate',

		// Almanac
		'sunrise'						=> 'sunrise',
		'sunset'						=> 'sunset',
		'moonrise'						=> 'moonrise',
		'moonset'						=> 'moonset',
		'moon_age'						=> 'moonage',
		'march_equinox'					=> 'marchequinox',
		'june_solstice'					=> 'junesolstice',
		'sep_equinox'					=> 'sepequinox',
		'dec_solstice'					=> 'decsolstice',
		'moon_perihel'					=> 'moonperihel',
		'moon_aphel'					=> 'moonaphel',
		'moon_perigee'					=> 'moonperigee',
		'moon_apogee'					=> 'moonapogee',
		'sun_eclipse'					=> 'suneclipse',
		'moon_eclipse'					=> 'mooneclipse',
		'first_quarter'					=> 'firstquarter',
		'full_moon'						=> 'fullmoon',
		'possible_daylight_hours' 		=> 'hoursofpossibledaylight',
		'last_quarter'					=> 'lastquarter',
		'next_new_moon'					=> 'nextnewmoon',
		'easter_date'					=> 'easterdate',

		// Clouds
		'cloud_height_feet'				=> 'cloudheightfeet',
		'cloud_height_meters'			=> 'cloudheightmeters',
		'us_navy_cloud_height_1'		=> 'usnavycloudheight1',
		'us_navy_cloud_height_2'		=> 'usnavycloudheight2',
		'us_navy_cloud_height_3'		=> 'usnavycloudheight3',
		'visibility'					=> 'visibility',

		// Current
		'temperature'					=> 'temp',
		'temperature_f'					=> 'tempinusa',
		'temperature_metric'			=> 'tempinmetric',
		'rounded_temperature_celcius'	=> 'wholeroundedtempcelcius',
		'rounded_temperature_faren'		=> 'wholeroundedtempfaren',
		'temperature_change_last_hour'			=> 'tempchangehour',
		'temperature_change_last_hour_f'		=> 'tempchangelasthourfaren',
		'temperature_change_last_hour_metric'	=> 'tempchangelasthourmetric',
		'24_hours_average_temperature'	=> 'last24houravtemp',
		'apparent_temperature'			=> 'apparenttemp',
		'apparent_temperature_c'		=> 'apparenttempc',
		'apparent_temperature_f'		=> 'apparenttempf',
		'apparent_solar_temperature'	=> 'apparentsolartemp',
		'apparent_solar_temperature_c'	=> 'apparentsolartempc',
		'apparent_solar_temperature_f'	=> 'apparentsolartempf',
		'humidity'						=> 'hum',
		'barometer'						=> 'baro',
		'barometer_in'					=> 'baroinusa',
		'barometer_mb'					=> 'currentpressureinmb',
		'barometer_inches2dp'			=> 'baroininches2dp',
		'barometer_metric'				=> 'baroinmetric',
		'barometer_trend'				=> 'trend',
		'barometer_trend_name'			=> 'pressuretrendname',
		'barometer_change_1_hours_mb'	=> 'pressurechangehourinmb',
		'barometer_change_3_hours'		=> 'pressurechangein3hour',
		'barometer_change_3_hours_mb'	=> 'pressurechange3hourinmb',
		'barometer_change_6_hours'		=> 'pressurechangein6hour',
		'barometer_change_6_hours_mb'	=> 'pressurechange6hourinmb',
		'barometer_change_12_hours'		=> 'pressurechangein12hour',
		'barometer_change_12_hours_mb'	=> 'pressurechange12hourinmb',
		'barometer_change_24_hours'		=> 'pressurechangein24hour',
		'barometer_change_24_hours_mb'	=> 'pressurechange24hourinmb',
		'vapour_pressure'				=> 'vapourpressure',
		'dew'							=> 'dew',
		'dew_faren'						=> 'dewinusa',
		'dew_metric'					=> 'dewinmetric',
		'heat_index'					=> 'heati',
		'heat_index_metric'				=> 'heatindexinmetric',
		'wind_chill'					=> 'windch',
		'wind_chill_metric'				=> 'windchillinmetric',
		'average_wind_speed'			=> 'avgspd',
		'average_wind_speed_mph'		=> 'windinmph',
		'average_wind_speed_metric'		=> 'avspeedinmetric',
		'gust_speed'					=> 'gstspd',
		'gust_speed_mph'				=> 'gustinmph',
		'gust_speed_metric'				=> 'gustspeedinmetric',
		'wind_direction_deg'			=> 'dirdeg',
		'wind_direction_label'			=> 'dirlabel',
		'wind_direction_words'			=> 'winddirinwords',
		'beaufort_wind_speed'			=> 'currbftspeed',
		'beaufort_wind_speed_text'		=> 'bftspeedtext',
		'beaufort_wind_speed_number'	=> 'beaufortnum',
		'today_wind_run'				=> 'windruntoday',
		'month_wind_run'				=> 'windruntodatethismonth',
		'year_wind_run'					=> 'windruntodatethisyear',
		'wet_bulb'						=> 'wetbulb',
		'davis_thsw_index'				=> 'thsw',
		'soil_temperature'				=> 'soiltemp',
		'humidex_f'						=> 'humidexfaren',
		'humidex_c'						=> 'humidexcelsius',
		'water_temperature_c'			=> 'watertempcelsius',
		'water_temperature_f'			=> 'watertempfaren',

		// Rain
		'days_with_no_rain'				=> 'dayswithnorain',
		'hour_rain'						=> 'hourrn',
		'hour_rain_mm'					=> 'rainlasthourmm',
		'3_hours_rain'					=> 'totalrainlast3hours',
		'3_hours_rain_mm'				=> 'rainlast3hourmm',
		'6_hours_rain'					=> 'totalrainlast6hours',
		'6_hours_rain_mm'				=> 'rainlast6hourmm',
		'24_hours_rain'					=> 'totalrainlast24hours',
		'today_rain'					=> 'dayrn',
		'today_rain_in'					=> 'dayrnusa',
		'today_rain_mm'					=> 'todayraininmm',
		'yesterday_rain'				=> 'ystdyrain',
		'yesterday_rain_in'				=> 'yesterdayrain',
		'yesterday_rain_mm'				=> 'yesterdayrainmm',
		'month_rain'					=> 'monthrn',
		'month_rain_mm'					=> 'monthraininmm',
		'month_average_rain'			=> 'currentmonthaveragerain',
		'year_rain'						=> 'yearrn',
		'year_rain_mm'					=> 'yearlyraininmm',
		'rain_duration'					=> 'rainduration',
		'rain_rate'						=> 'currentrainrate',
		'rain_rate_hr'					=> 'currentrainratehr',
		'rain_rate_mm'					=> 'currentrainratemm',
		'max_rain_minute_last_hour'		=> 'maxrainminlasthour',
		'max_rain_minute_last_hour_mm'	=> 'maxrainminlasthourmm',
		'max_rain_hour_last_6_hours'	=> 'maxrainhourlast6hours',
		'max_rain_hour_last_6_hours_mm'	=> 'maxrainhourlast6hoursmm',

		// Solar/UV
		'uv'							=> 'VPuv',
		'solar'							=> 'Solar',
		'solar_description'				=> 'Currentsolardescription',
		'day_sunshine_hours'			=> 'sunshinehourstodateday',
		'month_sunshine_hours'			=> 'sunshinehourstodatemonth',
		'year_sunshine_hours'			=> 'sunshinehourstodateyear',
		'solar_percent'					=> 'currentsolarpercent',
		'grow_solar'					=> 'growsolar',
		'solar_energy number'			=> 'VPsolar',
		'evapotranspiration'			=> 'VPet',
		'evapotranspiration_rate'		=> 'currentwdet',
		'yesterday_evapotranspiration_rate'	=> 'yesterdaywdet',

		// Indoor
		'indoor_temperature'			=> 'indoortemp',
		'indoor_temperature_metric'		=> 'indoortempinmetric',
		'indoor_humidity'				=> 'indoorhum',
		'indoor_dew_f'					=> 'indoordewfaren',
		'indoor_dew_c'					=> 'indoordewcelsius',

		// FWI
		'fwi_ffm_code'					=> 'FWIffmc',
		'fwi_build_up_index'			=> 'FWIbui',
		'fwi_initial_spread_index'		=> 'FWIisi',
		'fwi_duff_moisture_code'		=> 'FWIdmc',
		'fwi_drought_code'				=> 'FWIdc',
		'fwi_fire_weather_index'		=> 'FWIfwi',

		// Reports
		'weather_conditions'			=> 'weathercond',
		'weather_report'				=> 'weatherreport',
		'metar_report'					=> 'metarreport',
		'extra_metar_label'				=> 'extrametarlabel',
		'metar_cloud_report'			=> 'metarcloudreport',
		'wd_version'					=> 'wdversion',
		'input_daily_weather'			=> 'inputdailyweather',
		'heat_colour_word'				=> 'heatcolourword',
		'wind_gauge_pointer'			=> 'windgaugepointer',
		'gust_gauge_pointer'			=> 'gustgaugepointer',

		// Minutes
		'minute_max_average_wind_speed'				=> 'max1minuteavwind',
		'minute_max_gust_speed_ms'					=> 'maxgustlastmininms',
		'minute_max_gust_speed_metric'				=> 'maxgustlastmininkts',
		'10_minutes_average_wind_speed'				=> 'avtenminutewind',
		'10_minutes_average_wind_speed_ms'			=> 'currentavtenminutewindms',
		'10_minutes_average_wind_direction'			=> 'avdir10minute',
		'10_minutes_average_wind_direction_label'	=> 'curdir10minutelabel',
		'10_minutes_max_average_wind_speed'			=> 'highavtenminutewind',
		'10_minutes_max_average_wind_speed_ms'		=> 'highavtenminutewindms',
		'10_minutes_max_average_wind_speed_kts'		=> 'highavtenminutewindkts',
		'10_minutes_max_average_wind_speed_kmh'		=> 'highavtenminutewindkmh',

		// Hours
		'hour_max_gust_speed'			=> 'maxgsthr',
		'hour_max_gust_speed_ms'		=> 'maxgustlasthourinms',
		'hour_max_gust_speed_metric'	=> 'maxgustlasthourinmetric',
		'hour_max_gust_speed_time'		=> 'maxgsthrt',
		'12_hours_max_average_wind_speed'		=> 'max1minavspeedlast12hrs',
		'12_hours_max_average_wind_speed_ms'	=> 'max1minavspeedlast12hrsms',

		// Day
		'day_max_temperature'			=> 'maxtemp',
		'day_max_temperature_f'			=> 'hightempinusa',
		'day_max_temperature_time'		=> 'maxtempt',
		'day_min_temperature'			=> 'mintemp',
		'day_min_temperature_f'			=> 'lowtempinusa',
		'day_min_temperature_time'		=> 'mintempt',
		'day_max_indoor_temperature'		=> 'maxindoortemp',
		'day_max_indoor_temperature_c'		=> 'maxindoortempcelsius',
		'day_max_indoor_temperature_time'	=> 'maxindoortempt',
		'day_min_indoor_temperature'		=> 'minindoortemp',
		'day_min_indoor_temperature_c'		=> 'minindoortempcelsius',
		'day_min_indoor_temperature_time'	=> 'minindoortempt',
		'day_min_wind_chill'			=> 'minwindch',
		'day_max_wind_chill_metric'		=> 'maxhighchillinmetric',
		'day_min_wind_chill_time'		=> 'minwindcht',
		'day_max_wind_chill'			=> 'maxwindchill',
		'day_min_wind_chill_metric'		=> 'minlowchillinmetric',
		'day_max_wind_chill_time'		=> 'maxwindchillt',
		'day_max_humidity'				=> 'highhum',
		'day_max_humidity_time'			=> 'highhumt',
		'day_min_humidity'				=> 'lowhum',
		'day_min_humidity_time'			=> 'lowhumt',
		'day_max_barometer'				=> 'highbaro',
		'day_max_barometer_metric'		=> 'maxbaroinmetric',
		'day_max_barometer_time'		=> 'highbarot',
		'day_min_barometer'				=> 'lowbaro',
		'day_min_barometer_metric'		=> 'minbaroinmetric',
		'day_min_barometer_time'		=> 'lowbarot',
		'day_max_dew'					=> 'maxdew',
		'day_max_dew_metric'			=> 'maxhighdewinmetric',
		'day_max_dew_time'				=> 'maxdewt',
		'day_min_dew'					=> 'mindew',
		'day_min_dew_metric'			=> 'minlowdewinmetric',
		'day_min_dew_time'				=> 'mindewt',
		'day_max_heat_index'			=> 'maxheat',
		'day_max_heat_index_metric'		=> 'maxheatinmetric',
		'day_max_heat_index_time'		=> 'maxheatt',
		'day_min_heat_index'			=> 'minheat',
		'day_min_heat_index_metric'		=> 'minheatinmetric',
		'day_min_heat_index_time'		=> 'minheatt',
		'day_max_gust_speed'			=> 'maxgst',
		'day_max_gust_speed_metric'		=> 'maxdailygustinkts',
		'day_max_gust_speed_ms'			=> 'maxdailygustinms',
		'day_max_gust_speed_time'		=> 'maxgstt',
		'day_max_average_wind_speed'		=> 'maxavgspd',
		'day_max_average_wind_speed_metric'	=> 'maxavspeedinkts',
		'day_max_average_wind_speed_ms'		=> 'maxavspeedinms',
		'day_max_average_wind_speed_time'	=> 'maxavgspdt',
		'day_max_solar'					=> 'highsolar',
		'day_max_solar_time'			=> 'highsolartime',
		'day_min_solar'					=> 'lowsolar',
		'day_min_solar_time'			=> 'lowsolartime',
		'day_max_uv'					=> 'highuv',
		'day_max_uv_time'				=> 'highuvtime',
		'day_min_uv'					=> 'lowuv',
		'day_min_uv_time'				=> 'lowuvtime',

		// Yesterday
		'yesterday_max_temperature'			=> 'maxtempyest',
		'yesterday_max_temperature_time'	=> 'maxtempyestt',
		'yesterday_min_temperature'			=> 'mintempyest',
		'yesterday_min_temperature_time'	=> 'mintempyestt',
		'yesterday_max_gust_speed'			=> 'maxgustyest',
		'yesterday_max_gust_speed_time'		=> 'maxgustyestt',
		'yesterday_max_average_wind_speed'		=> 'maxaverageyest',
		'yesterday_max_average_wind_speed_time'	=> 'maxaverageyestt',
		'yesterday_max_barometer'		=> 'maxbaroyest',
		'yesterday_max_barometer_time'	=> 'maxbaroyestt',
		'yesterday_min_barometer'		=> 'minbaroyest',
		'yesterday_min_barometer_time'	=> 'minbaroyestt',
		'yesterday_max_dew'				=> 'maxdewyest',
		'yesterday_max_dew_time'		=> 'maxdewyestt',
		'yesterday_min_dew'				=> 'mindewyest',
		'yesterday_min_dew_time'		=> 'mindewyestt',
		'yesterday_max_humidity'		=> 'maxhumyest',
		'yesterday_max_humidity_time'	=> 'maxhumyestt',
		'yesterday_min_humidity'		=> 'minhumyest',
		'yesterday_min_humidity_time'	=> 'minhumyestt',
		'yesterday_max_wind_chill'		=> 'maxchillyest',
		'yesterday_max_wind_chill_time'	=> 'maxchillyestt',
		'yesterday_min_wind_chill'		=> 'minchillyest',
		'yesterday_min_wind_chill_time'	=> 'minchillyestt',
		'yesterday_max_heat_index'		=> 'maxheatyest',
		'yesterday_max_heat_index_time'	=> 'maxheatyestt',
		'yesterday_min_heat_index'		=> 'minheatyest',
		'yesterday_min_heat_index_time'	=> 'minheatyestt',
		'yesterday_max_indoor_temperature'		=> 'maxindoortempyest',
		'yesterday_max_indoor_temperature_time'	=> 'maxindoortempyestt',
		'yesterday_min_indoor_temperature'		=> 'minindoortempyest',
		'yesterday_min_indoor_temperature_time'	=> 'minindoortempyestt',
		'yesterday_max_uv'			=> 'highuvyest',
		'yesterday_max_uv_time'		=> 'highuvyesttime',
		'yesterday_min_uv'			=> 'lowuvyest',
		'yesterday_min_uv_time'		=> 'lowuvyesttime',

		// Month
		'month_average_temperature'		=> 'monthtodateavtemp',
		'month_average_temperature_c'	=> 'monthtodateavtempcelsius',
		'month_average_humidity'		=> 'monthtodateavhum',
		'month_average_dew'				=> 'monthtodateavdp',
		'month_average_dew_c'			=> 'monthtodateavdpcelsius',
		'month_average_barometer'		=> 'monthtodateavbaro',
		'month_average_barometer_hpa'	=> 'monthtodateavbaromb',
		'month_average_wind_speed'		=> 'monthtodateavspeed',
		'month_average_wind_speed_metric'	=> 'monthtodateavspeedkts',
		'month_average_wind_speed_ms'	=> 'monthtodateavspeedms',
		'month_average_wind_speed_kmh'	=> 'monthtodateavspeedkmh',
		'month_average_gust_speed'			=> 'monthtodateavgust',
		'month_average_gust_speed_metric'	=> 'monthtodateavgustkts',
		'month_average_gust_speed_ms'		=> 'monthtodateavgustms',
		'month_average_gust_speed_kmh'		=> 'monthtodateavgustkmh',
		'month_average_direction'		=> 'monthtodateavdir',
		'month_max_temperature'			=> 'monthtodatemaxtemp',
		'month_max_temperature_c'		=> 'monthtodatemaxtempcelsius',
		'month_min_temperature'			=> 'monthtodatemintemp',
		'month_min_temperature_c'		=> 'monthtodatemintempcelsius',
		'month_max_humidity'			=> 'monthtodatemaxhum',
		'month_min_humidity'			=> 'monthtodateminhum',
		'month_max_dew'					=> 'monthtodatemaxdp',
		'month_max_dew_c'				=> 'monthtodatemaxdpcelsius',
		'month_min_dew'					=> 'monthtodatemindp',
		'month_min_dew_c'				=> 'monthtodatemindpcelsius',
		'month_max_barometer'			=> 'monthtodatemaxbaro',
		'month_max_barometer_hpa'		=> 'monthtodatemaxbaromb',
		'month_min_barometer'			=> 'monthtodateminbaro',
		'month_min_barometer_hpa'		=> 'monthtodateminbaromb',
		'month_max_wind_speed'			=> 'monthtodatemaxwind',
		'month_max_wind_speed_ms'		=> 'monthtodatemaxwindms',
		'month_max_wind_speed_metric'	=> 'monthtodatemaxwindkts',
		'month_max_wind_speed_kmh'		=> 'monthtodatemaxwindkmh',
		'month_max_gust_speed'			=> 'monthtodatemaxgust',
		'month_max_gust_speed_ms'		=> 'monthtodatemaxgustms',
		'month_max_gust_speed_metric'	=> 'monthtodatemaxgustkts',
		'month_max_gust_speed_kmh'		=> 'monthtodatemaxgustkmh',

		// Extra
		'extra_temperature_1'			=> 'extratemp1',
		'general_extra_temperature_1'	=> 'generalextratemp1',
		'general_extra_temperature_2'	=> 'generalextratemp2',
		'general_extra_temperature_3'	=> 'generalextratemp3',
		'general_extra_temperature_4'	=> 'generalextratemp4',
		'general_extra_temperature_5'	=> 'generalextratemp5',
		'general_extra_temperature_6'	=> 'generalextratemp6',
		'general_extra_temperature_7'	=> 'generalextratemp7',
	);


	// --------------------------------------------------------------------
	// Public methods
	// --------------------------------------------------------------------

	/**
	 * Parse "clientraw.txt" file
	 *
	 * @access	private
	 * @param	string
	 * @return	array|bool
	 */
	public function parse_clientraw($content)
	{
		$return = $this->parse_clientraw_fields($content, $this->clientraw_fields);

		$return['date']                      = $this->format_date($return['date'], 'd.m.Y');
		$return['station_name']              = $this->format_station_name($return['station_name']);
		$return['weather_description']       = $this->format_description($return['weather_description']);
		$return['wind_direction_flag']       = $this->format_wind_direction($return['wind_direction']);
		$return['forecast_icon_description'] = $this->format_forecast_icon($return['forecast_icon']);

		return $return;
	}

	/**
	 * Parse "clientrawextra.txt" file
	 *
	 * @access	private
	 * @param	string
	 * @return	array|bool
	 */
	public function parse_clientrawextra($content)
	{
		$return = $this->parse_clientraw_fields($content, $this->clientrawextra_fields);

		$return['davis_vp_forecast_text'] = $this->format_description($return['davis_vp_forecast_text']);

		return $return;
	}

	/**
	 * Parse "clientrawhour.txt" file
	 *
	 * @access	private
	 * @param	string
	 * @return	array|bool
	 */
	public function parse_clientrawhour($content)
	{
		return $this->parse_clientraw_fields($content, $this->clientrawhour_fields, 2);
	}

	/**
	 * Parse "clientrawdaily.txt" file
	 *
	 * @access	private
	 * @param	string
	 * @return	array|bool
	 */
	public function parse_clientrawdaily($content)
	{
		return $this->parse_clientraw_fields($content, $this->clientrawdaily_fields);
	}

	/**
	 * Parse "wdfulldata.xml" file
	 *
	 * @access	private
	 * @param	string
	 * @return	array|bool
	 */
	public function parse_wdfulldata($content)
	{
		$return = $this->parse_xml_fields($content, $this->wdfulldata_fields);

		$report_params = array
		(
			'barometer_trend_name',
			'wind_direction_words',
			'beaufort_wind_speed_text',
			'solar_description',
			'weather_report',
			'heat_colour_word'
		);

		$return['beaufort_wind_speed_text'] = strtolower($return['beaufort_wind_speed_text']);

		foreach ($report_params as $param)
		{
			$return[$param] = $this->format_description($return[$param]);
		}

		$date_params = array
		(
			'wd_start_time',
			'march_equinox',
			'june_solstice',
			'sep_equinox',
			'dec_solstice',
			'moon_perihel',
			'moon_aphel',
			'moon_perigee',
			'moon_apogee',
			'sun_eclipse',
			'moon_eclipse',
			'first_quarter',
			'full_moon',
			'last_quarter',
			'next_new_moon',
			'easter_date'
		);

		foreach ($date_params as $param)
		{
			$return[$param] = $this->format_date($return[$param]);
		}

		$return['windows_uptime'] = $return['windows_uptime'] ? strtolower($return['windows_uptime']) : NULL;
		$return['date']           = $this->format_date($return['date'], 'd.m.Y');
		$return['metar_report']   = $this->format_metar_report($return['metar_report']);
		$return['moon_age']       = $this->format_moon_age($return['moon_age']);

		return $this->array_prepare($return);
	}

	/**
	 * Validate update date value in "clientraw.txt"
	 *
	 * @access	public
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
	public function validate_clientraw_date($content, $period = 600)
	{
		$time = mktime(
			$content['hour'],
			$content['minute'],
			$content['seconds'],
			$content['month'],
			$content['day'],
			$content['year']
		);

		if ($time < (time() - $period))
		{
			throw new Exception('File "clientraw.txt" data is oldest!');
		}

		return TRUE;
	}

	/**
	 * Validate update date value in "wdfulldata.xml"
	 *
	 * @access	public
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
	public function validate_wdfulldata_date($content, $period = 600)
	{
		$time = explode(':', $content['time']); // H:M
		$date = explode('.', $content['date']); // D/M/YYYY

		$time = mktime(
			$time[0],
			$time[1],
			0,
			$date[1],
			$date[0],
			$date[2]
		);

		if ($time < (time() - $period))
		{
			throw new Exception('File "wdfulldata.xml" data is oldest!');
		}

		return TRUE;
	}

	/**
	 * Validate last hour data fields in "clientrawhour.txt" by live data from "clientraw.txt"
	 *
	 * @access	public
	 * @param	array
	 * @param	array
	 * @param	int
	 * @param	array
	 * @return	bool
	 */
	public function validate_clientrawhour_fields($clientraw_content, $clientrawhour_content, $records = 60, $fields = NULL)
	{
		if (empty($content))
		{
			$fields = array
			(
				// in clientraw.txt => in clientrawhour.txt
				'wind_direction'	=> 'wind_direction',
				'temperature'		=> 'temperature',
				'humidity'			=> 'humidity',
				'barometer'			=> 'barometer',
			);
		}

		$data_corrupted = TRUE;

		foreach ($fields as $clientraw_field => $clientrawhour_field)
		{
			if (!isset($clientraw_content[$clientraw_field]))
			{
				throw new Exception('File "clientraw.txt" data parse error!');
			}

			if (!isset($clientrawhour_content[$clientrawhour_field]))
			{
				throw new Exception('File "clientrawhour.txt" data parse error!');
			}

			$slice = array_slice($clientrawhour_content[$clientrawhour_field], -$records);
			
			array_push($slice, $clientraw_content[$clientraw_field]);

			if (sizeof(array_unique($slice)) > 1)
			{
				$data_corrupted = FALSE;

				break;
			}
		}

		if ($data_corrupted)
		{
			throw new Exception('Data is corrupted (fields not is changed in last '.$records.' records)!');
		}

		return TRUE;
	}

	// --------------------------------------------------------------------
	// Private methods
	// --------------------------------------------------------------------

	/**
	 * Parse any clientraw "*.txt" file fields
	 *
	 * @access	private
	 * @param	array
	 * @param	array
	 * @return	array
	 */
	private function parse_clientraw_fields($content, $fields)
	{
		$content = preg_split('/\s+/', trim($content));
		$banner  = end($content);

		if (!preg_match('/^!!.+!!$/', $banner))
		{
			throw new Exception('File clientraw contains invalid format!');
		}

		$return = array();
		$pos = 0;

		foreach ($fields as $param => $perfs)
		{
			$pos  += $perfs[0];
			$count = $perfs[1];

			if (isset($content[$pos]) AND isset($content[$pos + $count]))
			{
				if ($count > 1)
				{
					if ($count == 6 AND stripos($param, 'record_') === 0)
					{
						if ($param)
						{
							$return[$param] = array
							(
								'value' => $content[$pos],
								'time'  => $content[$pos + 1].':'.$content[$pos + 2],
								'date'  => $content[$pos + 3].'.'.$content[$pos + 4].'.'.$content[$pos + 5],
							);
						}

						$pos += 6;
					}
					else
					{
						for ($i = 0; $i < $count; $i++)
						{
							if ($param)
							{
								$return[$param][$i] = $content[$pos + $i];
							}
						}

						$pos += $i;
					}
				}
				else
				{
					$return[$param] = $content[$pos];
					$pos += 1;
				}

				$combine = isset($perfs[2]) ? $perfs[2] : FALSE;

				if ($combine AND isset($return[$combine]))
				{
					$return[$param] = array_merge($return[$combine], $return[$param]);

					unset($return[$combine]);
				}
				
			}
			else
			{
				$return[$param] = NULL;
			}
		}

		$return['banner'] = $banner;

		return $this->array_prepare($return);
	}

	/**
	 * Parse any "*.xml" file fields
	 *
	 * @access	private
	 * @param	array
	 * @param	array
	 * @return	array
	 */
	private function parse_xml_fields($content, $fields)
	{
		$parser = xml_parser_create();

		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, $content, $values, $tags);
		xml_parser_free($parser);

		if (!is_array($values) OR !$values)
		{
			throw new Exception('File XML contains invalid format!');
		}

		$content = array();

		foreach ($values as $value)
		{
			if (isset($value['value']) AND $value['type'] == 'complete')
			{
				$content[$value['tag']] = $value['value'];
			}
		}

		if (!$content OR !isset($value['tag']) OR $value['tag'] != 'WXDATA')
		{
			throw new Exception('File XML contains invalid format!');
		}

		$return = array();

		foreach ($fields as $param => $field)
		{
			$return[$param] = isset($content[$field]) ? trim($content[$field]) : NULL;
		}

		return $return;
	}

	/**
	 * Format wind direction
	 *
	 * @access	private
	 * @param	string
	 * @return	array|bool
	 */
	private function format_wind_direction($content)
	{
		$replacement = array
		(
			'N', 'NNE', 'NE', 'ENE',
			'E', 'ESE', 'SE', 'SSE',
			'S', 'SSW', 'SW', 'WSW',
			'W', 'WNW', 'NW', 'NNW'
		);

		$index = fmod((($content + 11) / 22.5), 16);

		return isset($replacement[$index]) ? $replacement[$index] : NULL;
	}

	/**
	 * Format forecast icon
	 *
	 * @access	private
	 * @param	string
	 * @return	array|bool
	 */
	private function format_forecast_icon($content)
	{
		$content = trim($content);

		$replacement = array
		(
			'sunny',
			'clear night',
			'cloudy',
			'cloudy',
			'cloudy night',
			'dry clear',
			'fog',
			'hazy',
			'heavy rain',
			'mainly fine',
			'misty',
			'night fog',
			'night heavy rain',
			'night overcast',
			'night rain',
			'night showers',
			'night snow',
			'night thunder',
			'overcast',
			'partly cloudy',
			'rain',
			'hard rain',
			'showers',
			'sleet',
			'sleet showers',
			'snowing',
			'snow melt',
			'snow showers',
			'sunny',
			'thunder showers',
			'thunder showers',
			'thunderstorms',
			'tornado warning',
			'windy',
			'stopped raining',
			'windy rain',
			'sunrise',
			'sunset',
		);

		return isset($replacement[$content]) ? ucfirst($replacement[$content]) : NULL;
	}

	/**
	 * Format description text
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	private function format_description($content, $ucwords = FALSE)
	{
		if (empty($content))
		{
			return NULL;
		}

		return implode('. ', array_map($ucwords ? 'ucwords' : 'ucfirst', explode('. ', str_replace('_', ' ', ucfirst($content)))));
	}

	/**
	 * Format station name text
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	private function format_station_name($content)
	{
		if (empty($content))
		{
			return NULL;
		}

		$content = $this->format_description($content);

		$content = preg_replace('/-((\d+):(\d+):(\d+))$/is', ' - \\1', $content);

		return $content;
	}

	/**
	 * Format "moon_age" param value
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	private function format_moon_age($content)
	{
		if (!preg_match('/^Moon age: (\d+) days,(\d+) hours,(\d+) minutes,(\d+)%$/is', $content, $moon_age))
		{
			return NULL;
		}

		return
			$moon_age[1].' days '.
			$moon_age[2].' hours '.
			$moon_age[3].' minutes, '.
			$moon_age[4].'%';
	}

	/**
	 * Format METAR report
	 *
	 * @access	private
	 * @param	string
	 * @return	array|string
	 */
	private function format_metar_report($content)
	{
		if (empty($content))
		{
			return NULL;
		}

		$return = array
		(
			'content' => $content,
		);

		if (preg_match("/([\d]{4})\.([\d]{2})\.([\d]{2}) ([\d]{2})([\d]{2}) (UTC)/s", $content, $date) AND
			preg_match("/ob\: ([^\n]+)\n/s", $content, $ob))
		{
			$return['utc'] = $date[1].'.'.$date[2].'.'.$date[3].' '.$date[4].':'.$date[5].' '.$date[6];

			if (class_exists('Metar'))
			{
				try
				{
					$metar = new Metar($date[1].'/'.$date[2].'/'.$date[3].' '.$date[4].':'.$date[5]."\n".$ob[1]);

					if ($array = $metar->parse())
					{
						$return = array_merge($return, $array);
					}
				}
				catch (Exception $e)
				{
					return NULL;
				}
			}
		}

		return $return;
	}

	/**
	 * Format date string
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	private function format_date($content, $format = 'd.m.Y H:i:s')
	{
		if (empty($content))
		{
			return NULL;
		}

		if (($time = strtotime(str_replace('/', '.', $content))) != 0)
		{
			return date($format, $time);
		}

		$patterns = array
		(
			'/^(\d+):(\d+) ([^\s]+) (\d+) ([^\s]+) (\d+)/se' => 'self::parse_date_match("\\4", "\\5", "\\6")." \\1:\\2 \\3,"',
			'/^(\d+) ([^\s]+) (\d+)/se' => 'self::parse_date_match("\\1", "\\2", "\\3").","',
			'/^(\d+):(\d+) ([^\s]+)/s' => '\\1:\\2 \\3,',
		);

		foreach ($patterns as $pattern => $replacement)
		{
			$content_replaced = preg_replace($pattern, $replacement, $content);

			if ($content_replaced != $content)
			{
				$content = trim($content_replaced, ', ');
				break;
			}
		}

		if ($content)
		{
			return $content;
		}

		return NULL;
	}

	/**
	 * Parse date regexp match
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	private static function parse_date_match($day, $month, $year)
	{
		$month  = preg_replace('/я$/', 'й', mb_convert_case($month, MB_CASE_LOWER, 'UTF-8'));
		$locale =
			setlocale(LC_TIME, '0');
			setlocale(LC_TIME, self::$locale.'.UTF-8');

		$month_number = FALSE;

		for ($i = 1; $i <= 12; $i++)
		{
			$time_month     = mktime(0, 0, 0, $i, 1, 1970);
			$short_month    = date('M', $time_month);
			$short_month_lc = strftime('%b', $time_month);

			if (stripos($month, $short_month) === 0 OR
				stripos($month, $short_month_lc) === 0)
			{
				$month_number = sprintf("%02d", $i);

				break;
			}
		}

		setlocale(LC_TIME, $locale);

		if ($month_number)
		{
			return sprintf("%02d", $day).'.'.$month_number.'.'.$year;
		}

		return NULL;
	}

	/**
	 * Prepare array
	 *
	 * @access	private
	 * @param	array
	 * @return	array
	 */
	private function array_prepare($mixed)
	{
		if (is_array($mixed))
		{
			$return = array();

			foreach ($mixed as $key => $value)
			{
				$return[$this->array_prepare($key)] = $this->array_prepare($value);
			}

			return $return;
		}

		if (is_bool($mixed) OR is_int($mixed))
		{
			return $mixed;
		}

		if (is_numeric($mixed))
		{
			return (float) $mixed;
		}

		return $mixed;
	}
}

/* End of file */