<?php

namespace Lum\CLI;

/**
 * Static CLI-related utility functions.
 */
class Util
{
  /**
   * Parse command line arguments and populate an array with the results.
   *
   * @param ?array $args (Optional) Arguments to parse.
   *  If `null` (default), uses ``array_slice($argv, 1)``;
   * @param ?array &$to (Optional) Array to populate.
   *  If `null` (default), uses ``$_GET``;
   */
  public static function parse_get_args(?array $args=null, ?array &$to=null)
  {
    global $argv;

    if (is_null($args))
    {
      $args = array_slice($argv, 1);
    }

    if (is_null($to))
    {
      $to = &$_GET;
    }

    parse_str(implode('&', $args), $to);
  }

  /**
   * ``PHP_SAPI === 'cli'``
   */
  public static function isCLI(): bool
  {
    return (PHP_SAPI === 'cli');
  }
}

