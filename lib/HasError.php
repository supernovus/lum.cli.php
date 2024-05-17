<?php

namespace Lum\CLI;

use Lum\Text\Colours as LTC;

/**
 * A trait for application classes to use which provides a couple methods
 * for handling errors and displaying error messages.
 * 
 * It's highly recommended to have a property called ``usage_message``
 * in your class which must be a string template to be used in
 * usage messages. A placeholder (by default ``{help}``) in the template 
 * will be replaced by the appropriate parameter information.
 * 
 * A few optional properties may be used to add a bit of style to your
 * error messages:
 * 
 * - ``error_prefix``: A prefix for error messages.
 * - ``error_suffix``: A suffix for error messages.
 * - ``error_colour``: A colour for error messages.
 * - ``error_isbold``: Should error_colour be bold?
 * 
 */
trait HasError
{
  use \Lum\Meta\HasProps;

  /**
   * This must be consumed by a class that has a getParamsInstance()
   * method which must return the initialized copy of the Params instance.
   */
  abstract protected function getParamsInstance ();

  /**
   * A small wrapper method to write a string to STDERR.
   *
   * @param string $message  The message to write to STDERR.
   * 
   * @return int  The number of bytes written, or false on error.
   */
  public static function stderr ($message)
  {
    return fwrite(STDERR, $message);
  }

  /**
   * A method to display an error message along with a quick
   * note about how to get further help information.
   *
   * @param string $errmsg  The error message to write to STDERR.
   * @param int $errcode  The error code to exit the app with (default: 1)
   *
   * Not sure why you'd want to do this, but if the $errcode is less than 0
   * or greater than 254, the exit() statement will not be called at all.
   *
   */
  public function error ($errmsg, $errcode=1)
  {
    $params = $this->getParamsInstance();
    if (!($params instanceof Params))
    {
      throw new Exception("getParamsInstance did not return Params instance");
    }

    $prefix = $this->get_prop('error_prefix');
    $suffix = $this->get_prop('error_suffix');
    $colour = $this->get_prop('error_colour');
    $isbold = $this->get_prop('error_isbold', false);

    if (isset($prefix)) self::stderr($prefix);
    if (isset($colour)) 
    { // Colourize the message.
      $errmsg = LTC::fg($colour, $isbold) . $errmsg . LTC::NORMAL;
    }
    
    self::stderr("$errmsg");

    if (isset($suffix)) self::stderr($suffix);
    self::stderr("\n");

    $usageGroup = $params->getUsageGroup();
    $usageTemplate = $this->get_prop('usage_message');
    if (isset($usageGroup) && is_string($usageTemplate))
    {
      $usageParam = $usageGroup->getParam();
      $usageFlag = $usageParam->syntax();
      $usageTag = $params->help_placeholder;
      $usageText = str_replace($usageTag, $usageFlag, $usageTemplate);
      self::stderr("$usageText\n");
    }

    if ($errcode > -1 && $errcode < 255)
    {
      exit($errcode);
    }
  } // error()

}
