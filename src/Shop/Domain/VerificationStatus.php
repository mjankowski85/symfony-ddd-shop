<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shop\Domain;

enum VerificationStatus: string
{
    case TO_VERIFICATION = 'to_verication';
    case IN_VERIFICATION = 'in_verification';
    case REJECTED = 'rejected';
    case ACCEPTED = 'accepted';
}
