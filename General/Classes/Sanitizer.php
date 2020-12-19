<?php declare(strict_types=1);

namespace Nkf\General\Classes;


// TODO поддержка undefined ?name => string
// TODO поддержка name => ?string
class Sanitizer
{
    //TODO Create SanitizeHelper
    protected $sanitizeHelper;

    public function sanitize($data, string $key, string $spec)
    {
        $value = $data[$key] ?? null;
        $rule = $this->getRule(explode('|', $spec));
    }

    // TODO Rule
    protected function getRule(array $parameters) : Rule
    {
        $ruleType = trim($parameters[0], '?');
        return $this->sanitizeHelper->getRule($ruleType, $parameters);
    }
}
