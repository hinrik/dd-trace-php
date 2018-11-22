<?php

namespace DDTrace;

use OpenTracing\StartSpanOptions;
use OpenTracing\Tracer;


/**
 * A factory object to create instances of StartSpanOptions.
 */
class StartSpanOptionsFactory
{
    /**
     * Creates an instance of StartSpanOptions making sure that if DD specific distributed tracing headers exists
     * than the \OpenTracing\Span that is about to be started will get the proper reference to the remote Span.
     *
     * @param Tracer $tracer
     * @param array $options
     * @param array $headers An associative array containing header names and values.
     * @return StartSpanOptions
     */
    public static function createForWebRequest(Tracer $tracer, $options = [], $headers = [])
    {
        $asArray = $options;
        if ($spanContext = $tracer->extract(\OpenTracing\Formats\HTTP_HEADERS, $headers)) {
            $asArray['child_of'] = $spanContext;
        }

        return StartSpanOptions::create($asArray);
    }
}
