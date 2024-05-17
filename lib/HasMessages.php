<?php 

namespace Lum\CLI;

use Lum\Text\Colours as LTC;

/**
 * A trait for application classes to use which provides a couple methods
 * for handling short (single-line recommended) status messages.
 * 
 * A few optional properties may be used to add a bit of style to the
 * various pre-defined message types:
 * 
 * - ``msg_prefix``: A prefix for messages.
 * - ``msg_suffix``: A suffix for messages.
 * 
 * - ``msg_ok_colour``: A colour for ok() messages.
 * - ``msg_ok_isbold``: Should msg_ok_colour be bold?
 * 
 * - ``msg_warn_colour``: A colour for warn() messages.
 * - ``msg_warn_isbold``: Should msg_warn_colour be bold?
 * 
 */
trait HasMessages
{
  use \Lum\Meta\HasProps;

  /**
   * The method that powers ok() and warn()
   * 
   * This can be used to add additional message types.
   * 
   * @param string $msg Message to show
   * @param string|null $colour Colour to use?
   * @param bool $isbold Is $colour bold?
   * @return string Message with all formatting applied
   */
  public function msg (string $msg, string $colour=null, bool $isbold=false)
  {
    $prefix = $this->get_prop('msg_prefix');
    $suffix = $this->get_prop('msg_suffix');

    if (isset($prefix))
    {
      $msg = $prefix.$msg;
    }

    if (isset($colour)) 
    { // Colourize the message.
      $msg = LTC::fg($colour, $isbold) . $msg . LTC::NORMAL;
    }

    if (isset($suffix))
    {
      $msg .= $suffix;
    }
    
    $msg .= "\n";

    return $msg;
  }

  /**
   * Show a short status message indicating success
   * 
   * @param mixed $msg Message to show
   * @return string Message with all formatting applied
   */
  public function ok ($msg)
  {
    $colour = $this->get_prop('msg_ok_colour');
    $isbold = $this->get_prop('msg_ok_isbold', false);
    return $this->msg($msg, $colour, $isbold);
  }

  /**
   * Show a show status message indicating a warning
   * 
   * Warnings are non-fatal and won't exit the app unlike
   * the errors provided by the HasError trait.
   * 
   * @param mixed $msg 
   * @return string 
   */
  public function warn ($msg)
  {
    $colour = $this->get_prop('msg_warn_colour');
    $isbold = $this->get_prop('msg_warn_isbold', false);
    return $this->msg($msg, $colour, $isbold);
  }
  
}
