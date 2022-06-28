<?php

namespace Runthis\Media\Attributes;

use function floor;
use function in_array;
use function log;
use function pow;
use function sprintf;
use function str_ireplace;
use function str_replace;
use function str_split;
use function strtolower;

class Size
{
    /**
     * Set the bytes.
     */
    public function __construct(public int $bytes)
    {
    }

    /**
     * Format file size provided from bytes.
     *
     * Options:
     *     l: lowercase suffix (12.45 mb instead of 12.45 MB)
     *     s: spacing omitted (12.45MB instead of 12.45 MB)
     *     b: Ending "B" removed (12.45 M instead of 12.45 MB)
     */
    public function pretty(string $options = ''): string
    {
        $format = '%.02F %sB';
        $suffix = 'BKMGTPEZY';
        $options = str_split($options);

        // Set byte formatting
        $format = $this->bytes < 1024 ? (in_array('b', $options, true) ? '%.0F' : '%.0F %s') : $format;

        // Lowercase
        $suffix = in_array('l', $options, true) ? strtolower($suffix) : $suffix;
        $format = in_array('l', $options, true) ? str_replace('B', 'b', $format) : $format;

        // No ending "b"
        $format = in_array('b', $options, true) ? str_ireplace('b', '', $format) : $format;

        // No spacing
        $format = in_array('s', $options, true) ? str_replace(' ', '', $format) : $format;

        $index = floor(log($this->bytes) / log(1024));

        return sprintf($format, $this->bytes / pow(1024, $index), str_split($suffix)[$index]);
    }

    /**
     * Just send back the bytes.
     */
    public function __toString(): string
    {
        return (string) $this->bytes;
    }
}
