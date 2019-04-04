#!/bin/bash


# Get the list of currently avialable printers on mac
## /usr/bin/lpstat -p -d

# Set default printer
DEFAULT_PRINTER=Brother_HL_5470DW_series

/usr/bin/lpoptions -d $DEFAULT_PRINTER;

# Print a file
# /usr/bin/lpr filename
