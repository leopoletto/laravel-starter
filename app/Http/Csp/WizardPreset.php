<?php

namespace App\Http\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policy;
use Spatie\Csp\Preset;
use Spatie\Csp\Scheme;
use Spatie\Csp\Value;

class WizardPreset implements Preset
{
    public function configure(Policy $policy): void
    {
        $policy
            ->add(Directive::DEFAULT, [Keyword::NONE])
            ->add(Directive::BASE, Keyword::NONE)
            ->add(Directive::IMG, [Keyword::SELF, Scheme::DATA])
            ->add(Directive::STYLE, [Keyword::SELF, 'https://fon.nyc3.digitaloceanspaces.com'])
            ->addNonce(Directive::STYLE)
            ->add(Directive::CONNECT, 'cnd.fontlint.com')
            ->add(Directive::FORM_ACTION, [Keyword::SELF])
            ->add(Directive::FONT, [Keyword::SELF, 'https://fon.nyc3.digitaloceanspaces.com'])
            ->add(Directive::SCRIPT, [Keyword::SELF, 'https://plausible.io'])
            ->addNonce(Directive::SCRIPT)
            ->add(Directive::FRAME_ANCESTORS, [Keyword::NONE])
            ->add(Directive::MEDIA, [Keyword::SELF])
            ->add(Directive::MANIFEST, [Keyword::SELF])
            ->add(Directive::UPGRADE_INSECURE_REQUESTS, Value::NO_VALUE)
            ->add(Directive::REQUIRE_TRUSTED_TYPES_FOR, Keyword::SCRIPT);
    }
}
