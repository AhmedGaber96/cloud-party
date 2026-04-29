<?php

namespace App;

enum ProfessionalRoleEnum: string
{
    case AdvancePracticeNurses = 'Advance Practice Nurses';
    case BehavioralHealthClinicians = 'Behavioral Health Clinicians';
    case ClinicalReviewers = 'Clinical Reviewers';
    case Coordinators = 'Coordinators';
    case Dieticians = 'Dieticians';
    case Endocrinologists = 'Endocrinologists';
    case ExerciseCoordinator = 'Exercise Coordinator';
    case ExercisePhysiologists = 'Exercise Physiologists';
    case Internists = 'Internists';
    case Nurses = 'Nurses';
    case ObesityMedicineSpecialists = 'Obesity Medicine Specialists';
    case Pharmacologists = 'Pharmacologists';
    case PhysicalTherapists = 'Physical Therapists';
    case PhysicianAssistants = 'Physician Assistants';
    case Psychiatrists = 'Psychiatrists';
    case Psychologists = 'Psychologists';
    case RegisteredDietitians = 'Registered Dietitians';
    case Researchers = 'Researchers';
    case Surgeons = 'Surgeons';
    case Other = 'Other';

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->value])
            ->toArray();
    }
}