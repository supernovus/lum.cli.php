<?php 

namespace Lum\CLI\Themes; 

/**
 * A simple theme that doesn't use any prefixes or suffixes,
 * but simply uses green, yellow, and red test for
 * ok(), warn(), and error() messages respectively.
 */
trait Standard
{
  protected $msg_ok_colour   = 'green';
  protected $msg_warn_colour = 'yellow';
  protected $error_colour    = 'red';
}
