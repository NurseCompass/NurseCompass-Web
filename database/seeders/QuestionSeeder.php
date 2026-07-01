<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question; // <--- THIS IS REQUIRED

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        // --- 3rd Year Section: Academic Performance ---

        // Question 1
        $q1 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Academic Performance',
            'question_text' => 'You are caring for a 58-year-old male patient admitted for exacerbation of chronic obstructive pulmonary disease (COPD). His ABG results show pH 7.32, PaCO₂ 58 mmHg, HCO₃ 26 mEq/L, and PaO₂ 60 mmHg. He is becoming increasingly restless. Which of the following is your PRIORITY nursing action?'
        ]);
        $q1->options()->createMany([
            ['option_text' => 'A. Administer oxygen at 6–8 L/min via face mask to rapidly correct hypoxemia.', 'is_correct' => false],
            ['option_text' => 'B. Administer oxygen at 1–2 L/min via nasal cannula and prepare for possible non-invasive ventilation.', 'is_correct' => true],
            ['option_text' => 'C. Encourage the patient to perform deep breathing exercises immediately.', 'is_correct' => false],
            ['option_text' => 'D. Administer a bronchodilator via nebulizer and document the findings.', 'is_correct' => false],
        ]);

        // Question 2
        $q2 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Academic Performance',
            'question_text' => 'A post-operative patient on Day 1 following abdominal surgery suddenly develops dyspnea, pleuritic chest pain, and tachycardia. SpO₂ drops to 88% despite supplemental oxygen. The physician suspects pulmonary embolism. As the admitting nurse, what is the MOST appropriate immediate action?'
        ]);
        $q2->options()->createMany([
            ['option_text' => 'A. Position the patient in a semi-Fowler\'s position, notify the physician, and prepare for anticoagulation therapy.', 'is_correct' => true],
            ['option_text' => 'B. Administer morphine sulfate for pain relief and monitor vital signs every hour.', 'is_correct' => false],
            ['option_text' => 'C. Assist the patient to ambulate slowly to promote circulation and prevent further clot formation.', 'is_correct' => false],
            ['option_text' => 'D. Insert a urinary catheter to accurately monitor fluid intake and output.', 'is_correct' => false],
        ]);

        // Question 3
        $q3 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Academic Performance',
            'question_text' => 'During a barangay health assessment, you identify a cluster of 12 dengue cases within a two-week period in a sitio with poor garbage disposal. The barangay captain is asking for your recommendation. Which public health nursing intervention should be given HIGHEST priority?'
        ]);
        $q3->options()->createMany([
            ['option_text' => 'A. Conduct individual health teachings to all affected families on dengue signs and symptoms.', 'is_correct' => false],
            ['option_text' => 'B. Request for fogging operations from the municipal health office and distribute mosquito nets.', 'is_correct' => false],
            ['option_text' => 'C. Lead a community mobilization for source reduction—eliminating stagnant water breeding sites—and coordinate with the local health office for case surveillance.', 'is_correct' => true],
            ['option_text' => 'D. Refer all dengue-positive patients to the nearest district hospital for IV fluid management.', 'is_correct' => false],
        ]);

        // Question 4
        $q4 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Academic Performance',
            'question_text' => 'You are a public health nurse assigned to a coastal barangay. Survey data shows that 40% of children under five are underweight and 65% of households use untreated water. Which of the following reflects the MOST comprehensive approach to address the identified community health problems?'
        ]);
        $q4->options()->createMany([
            ['option_text' => 'A. Organize a supplemental feeding program for all underweight children immediately.', 'is_correct' => false],
            ['option_text' => 'B. Conduct a series of health education sessions focusing on nutrition and water sanitation.', 'is_correct' => false],
            ['option_text' => 'C. Collaborate with local government units to address water supply infrastructure, integrate supplemental feeding, and activate community health volunteers for monitoring.', 'is_correct' => true],
            ['option_text' => 'D. Refer the barangay to the Department of Social Welfare and Development (DSWD) for livelihood programs.', 'is_correct' => false],
        ]);

        // Question 5
        $q5 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Academic Performance',
            'question_text' => 'An 80-year-old woman living alone is brought to the clinic by her daughter. She scores 20/30 on the Mini-Mental State Examination (MMSE) and has fallen twice in the past month. Her medications include metformin, amlodipine, and alprazolam. Which nursing concern is the MOST immediate priority?'
        ]);
        $q5->options()->createMany([
            ['option_text' => 'A. Refer the patient to a geriatric psychiatrist for evaluation of dementia.', 'is_correct' => false],
            ['option_text' => 'B. Educate the daughter about long-term care facilities suitable for the patient.', 'is_correct' => false],
            ['option_text' => 'C. Review the medication regimen, identify fall risk factors related to alprazolam use, and implement a fall-prevention plan.', 'is_correct' => true],
            ['option_text' => 'D. Administer a comprehensive nutritional assessment to rule out malnutrition as a cause of cognitive decline.', 'is_correct' => false],
        ]);

        // Question 6
        $q6 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Academic Performance',
            'question_text' => 'You are conducting a home visit for a 75-year-old male patient recently discharged after a hip replacement. He lives with his son\'s family. During the visit, you notice multiple bruises in different stages of healing, poor hygiene, and the patient appears fearful when his son enters the room. What is the MOST appropriate nursing action?'
        ]);
        $q6->options()->createMany([
            ['option_text' => 'A. Document your findings, reassure the patient, and schedule a follow-up visit in two weeks.', 'is_correct' => false],
            ['option_text' => 'B. Privately ask the patient about his living situation using a validated elder abuse screening tool, document findings thoroughly, and report to appropriate authorities per mandatory reporting guidelines.', 'is_correct' => true],
            ['option_text' => 'C. Confront the son directly and educate him on proper elder care.', 'is_correct' => false],
            ['option_text' => 'D. Recommend immediate hospital readmission for further observation and wound care.', 'is_correct' => false],
        ]);

        // Question 7
        $q7 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Academic Performance',
            'question_text' => 'A 45-year-old woman with Type 1 diabetes presents to the emergency room with nausea, vomiting, fruity-smelling breath, blood glucose of 420 mg/dL, and ABG showing pH 7.18. She is confused and tachypneic. Which nursing intervention is MOST critical in the initial management?'
        ]);
        $q7->options()->createMany([
            ['option_text' => 'A. Administer subcutaneous regular insulin immediately based on the sliding scale.', 'is_correct' => false],
            ['option_text' => 'B. Establish IV access, initiate 0.9% NaCl IV infusion, and prepare IV regular insulin infusion as ordered.', 'is_correct' => true],
            ['option_text' => 'C. Offer oral clear fluids and encourage the patient to eat a carbohydrate-rich meal.', 'is_correct' => false],
            ['option_text' => 'D. Administer sodium bicarbonate IV to correct the metabolic acidosis.', 'is_correct' => false],
        ]);

        // Question 8
        $q8 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Academic Performance',
            'question_text' => 'During a psychiatric ward admission, a 28-year-old male patient with schizophrenia tells you, \'The TV is sending me messages to hurt my roommate tonight.\' He is pacing and clenching his fists. Which nursing action should be done FIRST?'
        ]);
        $q8->options()->createMany([
            ['option_text' => 'A. Document the patient\'s statement verbatim and inform the charge nurse at the end of the shift.', 'is_correct' => false],
            ['option_text' => 'B. Reassure the patient that the TV cannot send messages and redirect him to a group activity.', 'is_correct' => false],
            ['option_text' => 'C. Assess for immediate safety risk, initiate de-escalation techniques, ensure the safety of the roommate, and notify the attending physician promptly.', 'is_correct' => true],
            ['option_text' => 'D. Administer the prescribed PRN antipsychotic medication and place the patient in a quiet room alone.', 'is_correct' => false],
        ]);

        // --- 3rd Year Section: Self-Efficacy ---

        // Question 1
        $q9 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'During your first week in the medical ward, your senior nurse asks you to insert a peripheral IV line on a difficult-access patient. You have only practiced on simulation mannequins. What is your most likely response?'
        ]);
        $q9->options()->createMany([
            ['option_text' => 'A. Decline the task and tell the senior nurse you are not trained for it.', 'is_correct' => false],
            ['option_text' => 'B. Attempt the procedure without informing anyone of your skill level to avoid looking incompetent.', 'is_correct' => false],
            ['option_text' => 'C. Acknowledge your current skill level, ask for supervision, review the procedure first, and then attempt under guidance.', 'is_correct' => true],
            ['option_text' => 'D. Ask another nurse to do it since you are still new.', 'is_correct' => false],
        ]);

        // Question 2
        $q10 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'A patient\'s family is extremely upset and starts raising their voice at you, blaming you for their relative\'s deteriorating condition. How do you most likely handle the situation?'
        ]);
        $q10->options()->createMany([
            ['option_text' => 'A. Leave the room immediately to avoid escalation.', 'is_correct' => false],
            ['option_text' => 'B. Raise your voice back to assert your authority and professionalism.', 'is_correct' => false],
            ['option_text' => 'C. Calmly acknowledge the family\'s concerns, actively listen, provide factual information about the patient\'s condition, and offer to involve the physician.', 'is_correct' => true],
            ['option_text' => 'D. Ignore the outburst and continue your nursing tasks without responding.', 'is_correct' => false],
        ]);

        // Question 3
        $q11 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'You administered a medication at the correct dose, but realized afterward that you forgot to document it in the medication administration record (MAR). What do you do?'
        ]);
        $q11->options()->createMany([
            ['option_text' => 'A. Do nothing—since the medication was given correctly, documentation can wait.', 'is_correct' => false],
            ['option_text' => 'B. Ask a co-nurse to back-document for you after the shift.', 'is_correct' => false],
            ['option_text' => 'C. Immediately document the late entry with the correct time, notation of late entry, your signature, and inform the charge nurse.', 'is_correct' => true],
            ['option_text' => 'D. Leave it undocumented to avoid scrutiny.', 'is_correct' => false],
        ]);

        // Question 4
        $q12 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'Your head nurse assigns you to care for six patients on a busy shift—more than your usual load. You already feel overwhelmed. What is the best course of action?'
        ]);
        $q12->options()->createMany([
            ['option_text' => 'A. Accept all six patients without saying anything and do your best.', 'is_correct' => false],
            ['option_text' => 'B. Refuse all assignments and stay in the nurses\' station until the load is balanced.', 'is_correct' => false],
            ['option_text' => 'C. Communicate your concern to the head nurse, propose a patient prioritization plan, and ask if there are resources available to assist—while proceeding safely.', 'is_correct' => true],
            ['option_text' => 'D. Care for only the most critical patients and ignore the others.', 'is_correct' => false],
        ]);

        // Question 5
        $q13 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'A colleague challenges your clinical decision about a patient\'s positioning, saying you are wrong in front of the patient. How do you respond?'
        ]);
        $q13->options()->createMany([
            ['option_text' => 'A. Immediately agree with your colleague to avoid conflict in front of the patient.', 'is_correct' => false],
            ['option_text' => 'B. Argue with your colleague in front of the patient to defend your decision.', 'is_correct' => false],
            ['option_text' => 'C. Calmly acknowledge the concern, suggest continuing the discussion away from the patient, and collaboratively review the evidence-based rationale.', 'is_correct' => true],
            ['option_text' => 'D. Report the colleague to the head nurse for insubordination.', 'is_correct' => false],
        ]);

        // Question 6
        $q14 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'You notice that your documentation skills are weaker compared to your peers. How do you address this?'
        ]);
        $q14->options()->createMany([
            ['option_text' => 'A. Avoid situations where documentation is required.', 'is_correct' => false],
            ['option_text' => 'B. Ask peers to document on your behalf.', 'is_correct' => false],
            ['option_text' => 'C. Seek out opportunities to practice, review hospital documentation standards, and ask for feedback from senior nurses or your clinical instructor.', 'is_correct' => true],
            ['option_text' => 'D. Assume improvement will come naturally with time without any proactive steps.', 'is_correct' => false],
        ]);

        // Question 7
        $q15 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'You are assigned to a patient with a diagnosis you have not encountered before. What do you do before providing care?'
        ]);
        $q15->options()->createMany([
            ['option_text' => 'A. Provide care based on general nursing principles without reviewing the specific condition.', 'is_correct' => false],
            ['option_text' => 'B. Tell the patient you are unfamiliar with the condition and cannot help.', 'is_correct' => false],
            ['option_text' => 'C. Review the patient\'s chart, consult reliable clinical resources, seek guidance from the primary physician or a senior nurse, and plan your care accordingly.', 'is_correct' => true],
            ['option_text' => 'D. Ask to be reassigned to a patient you are more familiar with.', 'is_correct' => false],
        ]);

        // Question 8
        $q16 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'After a code blue that your team successfully managed, you feel your CPR compressions were not deep enough. What is the most appropriate next step?'
        ]);
        $q16->options()->createMany([
            ['option_text' => 'A. Assume you did fine since the patient survived.', 'is_correct' => false],
            ['option_text' => 'B. Stay silent to avoid any negative evaluation from your team.', 'is_correct' => false],
            ['option_text' => 'C. Reflect on your performance, seek feedback from the resuscitation team, and review CPR guidelines to improve your technique.', 'is_correct' => true],
            ['option_text' => 'D. Avoid participating in future resuscitation events.', 'is_correct' => false],
        ]);

        // --- 3rd Year Section: Initiative ---

        // Question 1
        $q17 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Initiative',
            'question_text' => 'While doing routine vital sign monitoring, you notice a patient\'s urinary output for the last four hours is only 80 mL (normal: ≥30 mL/hr). The patient is not in apparent distress. The attending physician has not been notified yet. What do you do?'
        ]);
        $q17->options()->createMany([
            ['option_text' => 'A. Wait until the next scheduled assessment to see if output improves.', 'is_correct' => false],
            ['option_text' => 'B. Document the finding and wait for the physician to make rounds.', 'is_correct' => false],
            ['option_text' => 'C. Immediately assess the patient further, review fluid intake and IV orders, report the finding to the physician using SBAR communication, and document all actions.', 'is_correct' => true],
            ['option_text' => 'D. Increase the IV fluid rate on your own to stimulate urinary output.', 'is_correct' => false],
        ]);

        // Question 2
        $q18 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Initiative',
            'question_text' => 'You notice that the sharps disposal container in your ward is nearly full. It is not yet your responsibility to replace it, and the charge nurse is in a meeting. What do you do?'
        ]);
        $q18->options()->createMany([
            ['option_text' => 'A. Continue using the full container until the charge nurse is available.', 'is_correct' => false],
            ['option_text' => 'B. Notify the charge nurse after the meeting and remind her to replace it.', 'is_correct' => false],
            ['option_text' => 'C. Proactively replace the container yourself following standard procedures and inform the charge nurse afterward to document the change.', 'is_correct' => true],
            ['option_text' => 'D. Avoid using the container and improvise a temporary solution.', 'is_correct' => false],
        ]);

        // Question 3
        $q19 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Initiative',
            'question_text' => 'A newly admitted patient is scheduled for a procedure in three hours. You review the chart and find that the consent form has not been signed yet, and the patient has not received any pre-procedure education. The admitting physician has not responded to your call. What action do you take?'
        ]);
        $q19->options()->createMany([
            ['option_text' => 'A. Proceed with pre-procedure preparation and assume the physician will handle the consent.', 'is_correct' => false],
            ['option_text' => 'B. Document the missing consent and wait for the physician to arrive.', 'is_correct' => false],
            ['option_text' => 'C. Conduct preliminary patient education about the procedure, escalate the unsigned consent issue to your supervisor, and make another attempt to reach the physician—documenting all communications.', 'is_correct' => true],
            ['option_text' => 'D. Cancel the procedure until the physician obtains consent.', 'is_correct' => false],
        ]);

        // Question 4
        $q20 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Initiative',
            'question_text' => 'You are the only nurse in the ward when a visiting family member collapses. You are not the assigned nurse for that area. What do you do?'
        ]);
        $q20->options()->createMany([
            ['option_text' => 'A. Call for help but do not touch the patient since it is not your assigned area.', 'is_correct' => false],
            ['option_text' => 'B. Tell the family to call 911 and return to your assigned patients.', 'is_correct' => false],
            ['option_text' => 'C. Immediately respond, assess the person\'s condition, initiate CPR if indicated, call for help, and notify the charge nurse.', 'is_correct' => true],
            ['option_text' => 'D. Ask the other visitors to assist while you find the assigned nurse.', 'is_correct' => false],
        ]);

        // Question 5
        $q21 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Initiative',
            'question_text' => 'During a team meeting, you identify a recurring issue where patients are not receiving discharge instructions before leaving. You are the most junior nurse on the team. What do you do?'
        ]);
        $q21->options()->createMany([
            ['option_text' => 'A. Say nothing because you are the most junior and it is not your place.', 'is_correct' => false],
            ['option_text' => 'B. Mention the problem to a senior nurse privately but take no further steps.', 'is_correct' => false],
            ['option_text' => 'C. Respectfully raise the concern during the meeting, present observed data, and suggest a checklist or workflow improvement for discharge education.', 'is_correct' => true],
            ['option_text' => 'D. Ignore the issue unless a patient complaint is formally filed.', 'is_correct' => false],
        ]);

        // Question 6
        $q22 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Initiative',
            'question_text' => 'You complete your assigned tasks with 30 minutes remaining in your shift. No additional tasks have been assigned to you. What is the most proactive course of action?'
        ]);
        $q22->options()->createMany([
            ['option_text' => 'A. Stay in the nurses\' station and wait until your shift ends.', 'is_correct' => false],
            ['option_text' => 'B. Offer to assist teammates, check on your patients one final time, update your end-of-shift notes, and ensure proper endorsement.', 'is_correct' => true],
            ['option_text' => 'C. Leave early since your tasks are done.', 'is_correct' => false],
            ['option_text' => 'D. Browse your phone since there is nothing left to do.', 'is_correct' => false],
        ]);

        // Question 7
        $q23 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Initiative',
            'question_text' => 'You observe that a colleague frequently skips hand hygiene between patient contacts. You have mentioned it once before and no change occurred. What is your next step?'
        ]);
        $q23->options()->createMany([
            ['option_text' => 'A. Ignore the behavior since you have already said something once.', 'is_correct' => false],
            ['option_text' => 'B. Report the colleague to administration without further discussion.', 'is_correct' => false],
            ['option_text' => 'C. Have a private, respectful follow-up conversation reinforcing the importance of hand hygiene for patient safety, and escalate to the charge nurse if behavior does not change.', 'is_correct' => true],
            ['option_text' => 'D. Publicly call out the colleague at the next team briefing.', 'is_correct' => false],
        ]);

        // Question 8
        $q24 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Initiative',
            'question_text' => 'You are invited to join a hospital committee for improving patient satisfaction scores. Participation is voluntary and outside your usual duties. What is your response?'
        ]);
        $q24->options()->createMany([
            ['option_text' => 'A. Decline because it is outside your job description.', 'is_correct' => false],
            ['option_text' => 'B. Agree but contribute minimally to avoid extra workload.', 'is_correct' => false],
            ['option_text' => 'C. Actively join the committee, contribute insights from your clinical experience, and help implement patient-centered improvements.', 'is_correct' => true],
            ['option_text' => 'D. Join only if you receive additional compensation.', 'is_correct' => false],
        ]);

        // --- 3rd Year Section: Motivation ---

        // Question 1
        $q25 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Motivation',
            'question_text' => 'After two months of working in a busy emergency department, you feel physically and emotionally drained and begin to dread going to work. What is the most constructive response to these feelings?'
        ]);
        $q25->options()->createMany([
            ['option_text' => 'A. Push through the fatigue without acknowledging it—nurses are expected to endure.', 'is_correct' => false],
            ['option_text' => 'B. Resign from the department immediately to protect your mental health.', 'is_correct' => false],
            ['option_text' => 'C. Recognize early signs of burnout, seek peer support or professional counseling, practice self-care strategies, and discuss workload concerns with your supervisor.', 'is_correct' => true],
            ['option_text' => 'D. Reduce effort at work to conserve energy and survive the shift.', 'is_correct' => false],
        ]);

        // Question 2
        $q26 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Motivation',
            'question_text' => 'You discover that a nurse who completed a similar nursing program as you is earning significantly more in a private hospital. You are currently working in a government hospital that you chose because of its mission. How do you process this?'
        ]);
        $q26->options()->createMany([
            ['option_text' => 'A. Immediately resign and apply to the higher-paying hospital.', 'is_correct' => false],
            ['option_text' => 'B. Feel resentful toward your institution and disengage from your work.', 'is_correct' => false],
            ['option_text' => 'C. Acknowledge the difference, reflect on your personal values and long-term career goals, explore salary negotiation or advancement opportunities within your current role, and reconnect with your purpose.', 'is_correct' => true],
            ['option_text' => 'D. Ignore the information entirely and never think about your financial goals.', 'is_correct' => false],
        ]);

        // Question 3
        $q27 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Motivation',
            'question_text' => 'A patient you have been closely caring for for a week unexpectedly dies during your shift. You feel a strong sense of grief and guilt. How do you best handle this experience?'
        ]);
        $q27->options()->createMany([
            ['option_text' => 'A. Suppress your emotions and continue the shift as if nothing happened.', 'is_correct' => false],
            ['option_text' => 'B. Leave the ward for the rest of the shift to compose yourself.', 'is_correct' => false],
            ['option_text' => 'C. Allow yourself to briefly process the loss, continue patient care responsibilities, debrief with a supervisor or colleague afterward, and seek grief counseling if needed.', 'is_correct' => true],
            ['option_text' => 'D. Become detached from all patients in the future to avoid similar feelings.', 'is_correct' => false],
        ]);

        // Question 4
        $q28 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Motivation',
            'question_text' => 'You receive critical feedback from your clinical supervisor stating that your patient education approach needs significant improvement. How do you most productively respond?'
        ]);
        $q28->options()->createMany([
            ['option_text' => 'A. Dismiss the feedback as unfair and do nothing differently.', 'is_correct' => false],
            ['option_text' => 'B. Feel defeated and consider leaving the nursing profession.', 'is_correct' => false],
            ['option_text' => 'C. Thank your supervisor for the feedback, ask for specific examples and improvement strategies, and create a personal development plan to address the gap.', 'is_correct' => true],
            ['option_text' => 'D. Agree verbally but make no real changes to avoid further criticism.', 'is_correct' => false],
        ]);

        // Question 5
        $q29 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Motivation',
            'question_text' => 'After six months of working as a staff nurse, you feel your daily tasks have become routine and no longer challenging. What is the most motivation-sustaining response?'
        ]);
        $q29->options()->createMany([
            ['option_text' => 'A. Accept the routine as inevitable and lower your expectations.', 'is_correct' => false],
            ['option_text' => 'B. Request a transfer to a new unit, pursue continuing education, or take on a new role such as preceptor or committee member to reinvigorate your practice.', 'is_correct' => true],
            ['option_text' => 'C. Do only the minimum required since there is nothing new to learn.', 'is_correct' => false],
            ['option_text' => 'D. Complain to colleagues about the lack of challenge to get sympathy.', 'is_correct' => false],
        ]);

        // Question 6
        $q30 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Motivation',
            'question_text' => 'You are preparing for the Philippine Nursing Licensure Examination (PNLE) while completing your final practicum. You feel overwhelmed by the dual demands. What is the BEST approach?'
        ]);
        $q30->options()->createMany([
            ['option_text' => 'A. Focus entirely on the PNLE and put in minimal effort in practicum.', 'is_correct' => false],
            ['option_text' => 'B. Prioritize your practicum duties and delay PNLE review until after graduation.', 'is_correct' => false],
            ['option_text' => 'C. Create a structured study-and-practicum schedule, use evidence-based review strategies, set realistic daily goals, and seek support from peers and instructors.', 'is_correct' => true],
            ['option_text' => 'D. Ask to be excused from practicum to maximize PNLE preparation.', 'is_correct' => false],
        ]);

        // Question 7
        $q31 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Motivation',
            'question_text' => 'A patient tells you, \'You\'re the first nurse who actually listened to me in this hospital.\' This positive feedback affects you. What is the most growth-oriented response?'
        ]);
        $q31->options()->createMany([
            ['option_text' => 'A. Feel proud momentarily but don\'t change anything in your practice.', 'is_correct' => false],
            ['option_text' => 'B. Use the experience as motivation to advocate for patient-centered care improvements in your unit, share the feedback with your team, and continue modeling compassionate care.', 'is_correct' => true],
            ['option_text' => 'C. Tell other nurses they should communicate better based on this one patient\'s comment.', 'is_correct' => false],
            ['option_text' => 'D. Share the comment on social media to highlight your personal achievement.', 'is_correct' => false],
        ]);

        // Question 8
        $q32 = Question::create([
            'year_level' => '3rd Year',
            'section' => 'Motivation',
            'question_text' => 'You are offered a scholarship for a Master\'s degree in Nursing, but it will require you to work in a rural health unit for two years after completion. You are currently comfortable in a city-based hospital. What is your most professionally motivated response?'
        ]);
        $q32->options()->createMany([
            ['option_text' => 'A. Decline immediately because rural work is outside your comfort zone.', 'is_correct' => false],
            ['option_text' => 'B. Accept without thinking through the commitment just because it is a scholarship.', 'is_correct' => false],
            ['option_text' => 'C. Carefully weigh the opportunity against your career goals, consider the public health impact, and if it aligns with your values and long-term plans, accept and prepare meaningfully for the experience.', 'is_correct' => true],
            ['option_text' => 'D. Accept but plan to find a way out of the rural assignment after graduation.', 'is_correct' => false],
        ]);


        // --- 4th Year Section: Academic Performance ---

        // Question 1
        $q33 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Academic Performance',
            'question_text' => 'A 55-year-old male patient in the ICU following a motor vehicle accident develops worsening hypotension (BP 70/40 mmHg), tachycardia (HR 128 bpm), distended neck veins, absent breath sounds on the left, and tracheal deviation to the right. Which nursing action is MOST urgent?'
        ]);
        $q33->options()->createMany([
            ['option_text' => 'A. Prepare for emergency pericardiocentesis for suspected cardiac tamponade.', 'is_correct' => false],
            ['option_text' => 'B. Immediately notify the physician, prepare for needle thoracostomy for suspected tension pneumothorax, and ensure IV access.', 'is_correct' => true],
            ['option_text' => 'C. Administer 1 L of 0.9% NaCl rapidly and reassess blood pressure.', 'is_correct' => false],
            ['option_text' => 'D. Obtain a STAT chest X-ray to confirm the diagnosis before any intervention.', 'is_correct' => false],
        ]);

        // Question 2
        $q34 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Academic Performance',
            'question_text' => 'You are caring for a post-cardiac surgery patient on Day 2. The patient suddenly becomes unresponsive, pulseless, and the cardiac monitor shows ventricular fibrillation. No defibrillator is immediately available. What is the CORRECT sequence of actions?'
        ]);
        $q34->options()->createMany([
            ['option_text' => 'A. Call for help, start high-quality CPR immediately, attach and use the defibrillator as soon as it arrives, and follow the ACLS algorithm.', 'is_correct' => true],
            ['option_text' => 'B. Call for help, administer a precordial thump, and wait for the defibrillator.', 'is_correct' => false],
            ['option_text' => 'C. Check for a pulse for 30 seconds, then begin CPR if absent.', 'is_correct' => false],
            ['option_text' => 'D. Administer 1 mg epinephrine IV immediately while calling for the defibrillator.', 'is_correct' => false],
        ]);

        // Question 3
        $q35 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Academic Performance',
            'question_text' => 'As a newly licensed nurse assigned as team leader during a busy evening shift, you have four patients. Two require wound dressing changes, one needs pre-operative teaching, and one requires hourly neurological checks post-craniotomy. A nursing aide (NA) is assigned to your team. Which task assignment BEST reflects the principles of delegation?'
        ]);
        $q35->options()->createMany([
            ['option_text' => 'A. Assign all four tasks to yourself to ensure quality care.', 'is_correct' => false],
            ['option_text' => 'B. Delegate the hourly neurological checks to the NA to free up your time for the other three tasks.', 'is_correct' => false],
            ['option_text' => 'C. Delegate the wound dressing changes to the NA, perform pre-operative teaching yourself, and personally conduct the hourly neurological checks on the post-craniotomy patient.', 'is_correct' => true],
            ['option_text' => 'D. Ask another nurse to handle the post-craniotomy patient while you complete the remaining tasks.', 'is_correct' => false],
        ]);

        // Question 4
        $q36 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Academic Performance',
            'question_text' => 'During a routine morning report, a staff nurse informs you that a patient received the wrong medication dose last night due to a transcription error. The patient is currently stable and asymptomatic. As the charge nurse, what is the MOST appropriate initial action?'
        ]);
        $q36->options()->createMany([
            ['option_text' => 'A. Reprimand the nurse who administered the medication in front of the team as a deterrent.', 'is_correct' => false],
            ['option_text' => 'B. Assess the patient\'s current condition, ensure safety, document the incident accurately, complete an incident report, and notify the physician and the patient.', 'is_correct' => true],
            ['option_text' => 'C. Advise the staff nurse to keep the error confidential to avoid patient anxiety.', 'is_correct' => false],
            ['option_text' => 'D. Transfer the patient to another ward to minimize association with the incident.', 'is_correct' => false],
        ]);

        // Question 5
        $q37 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Academic Performance',
            'question_text' => 'A Filipino nurse working in a hospital in the Middle East is assigned a Muslim female patient who refuses to be examined by a male physician and requests a female nurse to be present at all times. The male physician insists on conducting the full physical exam alone. What is the BEST nursing response?'
        ]);
        $q37->options()->createMany([
            ['option_text' => 'A. Inform the patient that hospital policy requires male physicians to conduct examinations and she must comply.', 'is_correct' => false],
            ['option_text' => 'B. Advocate for the patient\'s cultural and religious preferences, communicate the patient\'s request to the care team, and facilitate a culturally sensitive care plan.', 'is_correct' => true],
            ['option_text' => 'C. Excuse yourself from the room to avoid conflict between the patient and the physician.', 'is_correct' => false],
            ['option_text' => 'D. Document the patient\'s refusal as non-compliance and notify the supervisor.', 'is_correct' => false],
        ]);

        // Question 6
        $q38 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Academic Performance',
            'question_text' => 'A magnitude 7.2 earthquake strikes a city. You are a nurse volunteer at a field triage area. A 35-year-old male with a crush injury to his right leg is brought in. He is unconscious, has a Glasgow Coma Scale (GCS) of 6, BP 80/50 mmHg, and RR 8 breaths/min. Using the START triage system, how should this patient be categorized?'
        ]);
        $q38->options()->createMany([
            ['option_text' => 'A. Green (Minor) – he is stable enough to wait for treatment.', 'is_correct' => false],
            ['option_text' => 'B. Yellow (Delayed) – he needs treatment but can wait.', 'is_correct' => false],
            ['option_text' => 'C. Red (Immediate) – he has life-threatening injuries that can be treated with available resources.', 'is_correct' => false],
            ['option_text' => 'D. Black (Expectant) – his injuries are too severe given the available resources.', 'is_correct' => true],
        ]);

        // Question 7
        $q39 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Academic Performance',
            'question_text' => 'You are the nursing coordinator during a typhoon evacuation. A group of 200 evacuees has arrived at a gymnasium turned evacuation center. Among them are 15 pregnant women, 30 children under five, and 10 elderly individuals with chronic illnesses. Which priority action reflects effective disaster nursing management?'
        ]);
        $q39->options()->createMany([
            ['option_text' => 'A. Distribute food and water equally to all evacuees before conducting any health assessment.', 'is_correct' => false],
            ['option_text' => 'B. Immediately set up a triage and health assessment area, prioritize vulnerable groups (pregnant women, young children, elderly), establish medication access for those with chronic conditions, and coordinate with LGU and DOH.', 'is_correct' => true],
            ['option_text' => 'C. Focus all nursing activities on the pregnant women first, then attend to others when available.', 'is_correct' => false],
            ['option_text' => 'D. Wait for the official DOH Disaster Response Team before initiating any nursing interventions.', 'is_correct' => false],
        ]);

        // Question 8
        $q40 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Academic Performance',
            'question_text' => 'On your final week of hospital practicum in a medical-surgical unit, your clinical instructor asks you to perform a urinary catheter insertion on a conscious male patient. As you prepare, you realize you are unsure of the correct sterile technique for male catheterization. What is the MOST professionally appropriate action?'
        ]);
        $q40->options()->createMany([
            ['option_text' => 'A. Proceed with the procedure to avoid embarrassment and figure it out as you go.', 'is_correct' => false],
            ['option_text' => 'B. Tell the patient you will return later and skip the procedure entirely.', 'is_correct' => false],
            ['option_text' => 'C. Inform your clinical instructor of your uncertainty, request supervision or a skills review, and perform the procedure under direct supervision to ensure patient safety.', 'is_correct' => true],
            ['option_text' => 'D. Ask another student nurse who has performed the procedure before to do it instead.', 'is_correct' => false],
        ]);

        // --- 4th Year Section: Self-Efficacy ---

        // Question 1
        $q41 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'During your first week in the medical ward, your senior nurse asks you to insert a peripheral IV line on a difficult-access patient. You have only practiced on simulation mannequins. What is your most likely response?'
        ]);
        $q41->options()->createMany([
            ['option_text' => 'A. Decline the task and tell the senior nurse you are not trained for it.', 'is_correct' => false],
            ['option_text' => 'B. Attempt the procedure without informing anyone of your skill level to avoid looking incompetent.', 'is_correct' => false],
            ['option_text' => 'C. Acknowledge your current skill level, ask for supervision, review the procedure first, and then attempt under guidance.', 'is_correct' => true],
            ['option_text' => 'D. Ask another nurse to do it since you are still new.', 'is_correct' => false],
        ]);

        // Question 2
        $q42 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'A patient\'s family is extremely upset and starts raising their voice at you, blaming you for their relative\'s deteriorating condition. How do you most likely handle the situation?'
        ]);
        $q42->options()->createMany([
            ['option_text' => 'A. Leave the room immediately to avoid escalation.', 'is_correct' => false],
            ['option_text' => 'B. Raise your voice back to assert your authority and professionalism.', 'is_correct' => false],
            ['option_text' => 'C. Calmly acknowledge the family\'s concerns, actively listen, provide factual information about the patient\'s condition, and offer to involve the physician.', 'is_correct' => true],
            ['option_text' => 'D. Ignore the outburst and continue your nursing tasks without responding.', 'is_correct' => false],
        ]);

        // Question 3
        $q43 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'You administered a medication at the correct dose, but realized afterward that you forgot to document it in the medication administration record (MAR). What do you do?'
        ]);
        $q43->options()->createMany([
            ['option_text' => 'A. Do nothing—since the medication was given correctly, documentation can wait.', 'is_correct' => false],
            ['option_text' => 'B. Ask a co-nurse to back-document for you after the shift.', 'is_correct' => false],
            ['option_text' => 'C. Immediately document the late entry with the correct time, notation of late entry, your signature, and inform the charge nurse.', 'is_correct' => true],
            ['option_text' => 'D. Leave it undocumented to avoid scrutiny.', 'is_correct' => false],
        ]);

        // Question 4
        $q44 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'Your head nurse assigns you to care for six patients on a busy shift—more than your usual load. You already feel overwhelmed. What is the best course of action?'
        ]);
        $q44->options()->createMany([
            ['option_text' => 'A. Accept all six patients without saying anything and do your best.', 'is_correct' => false],
            ['option_text' => 'B. Refuse all assignments and stay in the nurses\' station until the load is balanced.', 'is_correct' => false],
            ['option_text' => 'C. Communicate your concern to the head nurse, propose a patient prioritization plan, and ask if there are resources available to assist—while proceeding safely.', 'is_correct' => true],
            ['option_text' => 'D. Care for only the most critical patients and ignore the others.', 'is_correct' => false],
        ]);

        // Question 5
        $q45 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'A colleague challenges your clinical decision about a patient\'s positioning, saying you are wrong in front of the patient. How do you respond?'
        ]);
        $q45->options()->createMany([
            ['option_text' => 'A. Immediately agree with your colleague to avoid conflict in front of the patient.', 'is_correct' => false],
            ['option_text' => 'B. Argue with your colleague in front of the patient to defend your decision.', 'is_correct' => false],
            ['option_text' => 'C. Calmly acknowledge the concern, suggest continuing the discussion away from the patient, and collaboratively review the evidence-based rationale.', 'is_correct' => true],
            ['option_text' => 'D. Report the colleague to the head nurse for insubordination.', 'is_correct' => false],
        ]);

        // Question 6
        $q46 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'You notice that your documentation skills are weaker compared to your peers. How do you address this?'
        ]);
        $q46->options()->createMany([
            ['option_text' => 'A. Avoid situations where documentation is required.', 'is_correct' => false],
            ['option_text' => 'B. Ask peers to document on your behalf.', 'is_correct' => false],
            ['option_text' => 'C. Seek out opportunities to practice, review hospital documentation standards, and ask for feedback from senior nurses or your clinical instructor.', 'is_correct' => true],
            ['option_text' => 'D. Assume improvement will come naturally with time without any proactive steps.', 'is_correct' => false],
        ]);

        // Question 7
        $q47 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'You are assigned to a patient with a diagnosis you have not encountered before. What do you do before providing care?'
        ]);
        $q47->options()->createMany([
            ['option_text' => 'A. Provide care based on general nursing principles without reviewing the specific condition.', 'is_correct' => false],
            ['option_text' => 'B. Tell the patient you are unfamiliar with the condition and cannot help.', 'is_correct' => false],
            ['option_text' => 'C. Review the patient\'s chart, consult reliable clinical resources, seek guidance from the primary physician or a senior nurse, and plan your care accordingly.', 'is_correct' => true],
            ['option_text' => 'D. Ask to be reassigned to a patient you are more familiar with.', 'is_correct' => false],
        ]);

        // Question 8
        $q48 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Self-Efficacy',
            'question_text' => 'After a code blue that your team successfully managed, you feel your CPR compressions were not deep enough. What is the most appropriate next step?'
        ]);
        $q48->options()->createMany([
            ['option_text' => 'A. Assume you did fine since the patient survived.', 'is_correct' => false],
            ['option_text' => 'B. Stay silent to avoid any negative evaluation from your team.', 'is_correct' => false],
            ['option_text' => 'C. Reflect on your performance, seek feedback from the resuscitation team, and review CPR guidelines to improve your technique.', 'is_correct' => true],
            ['option_text' => 'D. Avoid participating in future resuscitation events.', 'is_correct' => false],
        ]);

        // --- 4th Year Section: Initiative ---

        // Question 1
        $q49 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Initiative',
            'question_text' => 'While doing routine vital sign monitoring, you notice a patient\'s urinary output for the last four hours is only 80 mL (normal: ≥30 mL/hr). The patient is not in apparent distress. The attending physician has not been notified yet. What do you do?'
        ]);
        $q49->options()->createMany([
            ['option_text' => 'A. Wait until the next scheduled assessment to see if output improves.', 'is_correct' => false],
            ['option_text' => 'B. Document the finding and wait for the physician to make rounds.', 'is_correct' => false],
            ['option_text' => 'C. Immediately assess the patient further, review fluid intake and IV orders, report the finding to the physician using SBAR communication, and document all actions.', 'is_correct' => true],
            ['option_text' => 'D. Increase the IV fluid rate on your own to stimulate urinary output.', 'is_correct' => false],
        ]);

        // Question 2
        $q50 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Initiative',
            'question_text' => 'You notice that the sharps disposal container in your ward is nearly full. It is not yet your responsibility to replace it, and the charge nurse is in a meeting. What do you do?'
        ]);
        $q50->options()->createMany([
            ['option_text' => 'A. Continue using the full container until the charge nurse is available.', 'is_correct' => false],
            ['option_text' => 'B. Notify the charge nurse after the meeting and remind her to replace it.', 'is_correct' => false],
            ['option_text' => 'C. Proactively replace the container yourself following standard procedures and inform the charge nurse afterward to document the change.', 'is_correct' => true],
            ['option_text' => 'D. Avoid using the container and improvise a temporary solution.', 'is_correct' => false],
        ]);

        // Question 3
        $q51 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Initiative',
            'question_text' => 'A newly admitted patient is scheduled for a procedure in three hours. You review the chart and find that the consent form has not been signed yet, and the patient has not received any pre-procedure education. The admitting physician has not responded to your call. What action do you take?'
        ]);
        $q51->options()->createMany([
            ['option_text' => 'A. Proceed with pre-procedure preparation and assume the physician will handle the consent.', 'is_correct' => false],
            ['option_text' => 'B. Document the missing consent and wait for the physician to arrive.', 'is_correct' => false],
            ['option_text' => 'C. Conduct preliminary patient education about the procedure, escalate the unsigned consent issue to your supervisor, and make another attempt to reach the physician—documenting all communications.', 'is_correct' => true],
            ['option_text' => 'D. Cancel the procedure until the physician obtains consent.', 'is_correct' => false],
        ]);

        // Question 4
        $q52 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Initiative',
            'question_text' => 'You are the only nurse in the ward when a visiting family member collapses. You are not the assigned nurse for that area. What do you do?'
        ]);
        $q52->options()->createMany([
            ['option_text' => 'A. Call for help but do not touch the patient since it is not your assigned area.', 'is_correct' => false],
            ['option_text' => 'B. Tell the family to call 911 and return to your assigned patients.', 'is_correct' => false],
            ['option_text' => 'C. Immediately respond, assess the person\'s condition, initiate CPR if indicated, call for help, and notify the charge nurse.', 'is_correct' => true],
            ['option_text' => 'D. Ask the other visitors to assist while you find the assigned nurse.', 'is_correct' => false],
        ]);

        // Question 5
        $q53 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Initiative',
            'question_text' => 'During a team meeting, you identify a recurring issue where patients are not receiving discharge instructions before leaving. You are the most junior nurse on the team. What do you do?'
        ]);
        $q53->options()->createMany([
            ['option_text' => 'A. Say nothing because you are the most junior and it is not your place.', 'is_correct' => false],
            ['option_text' => 'B. Mention the problem to a senior nurse privately but take no further steps.', 'is_correct' => false],
            ['option_text' => 'C. Respectfully raise the concern during the meeting, present observed data, and suggest a checklist or workflow improvement for discharge education.', 'is_correct' => true],
            ['option_text' => 'D. Ignore the issue unless a patient complaint is formally filed.', 'is_correct' => false],
        ]);

        // Question 6
        $q54 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Initiative',
            'question_text' => 'You complete your assigned tasks with 30 minutes remaining in your shift. No additional tasks have been assigned to you. What is the most proactive course of action?'
        ]);
        $q54->options()->createMany([
            ['option_text' => 'A. Stay in the nurses\' station and wait until your shift ends.', 'is_correct' => false],
            ['option_text' => 'B. Offer to assist teammates, check on your patients one final time, update your end-of-shift notes, and ensure proper endorsement.', 'is_correct' => true],
            ['option_text' => 'C. Leave early since your tasks are done.', 'is_correct' => false],
            ['option_text' => 'D. Browse your phone since there is nothing left to do.', 'is_correct' => false],
        ]);

        // Question 7
        $q55 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Initiative',
            'question_text' => 'You observe that a colleague frequently skips hand hygiene between patient contacts. You have mentioned it once before and no change occurred. What is your next step?'
        ]);
        $q55->options()->createMany([
            ['option_text' => 'A. Ignore the behavior since you have already said something once.', 'is_correct' => false],
            ['option_text' => 'B. Report the colleague to administration without further discussion.', 'is_correct' => false],
            ['option_text' => 'C. Have a private, respectful follow-up conversation reinforcing the importance of hand hygiene for patient safety, and escalate to the charge nurse if behavior does not change.', 'is_correct' => true],
            ['option_text' => 'D. Publicly call out the colleague at the next team briefing.', 'is_correct' => false],
        ]);

        // Question 8
        $q56 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Initiative',
            'question_text' => 'You are invited to join a hospital committee for improving patient satisfaction scores. Participation is voluntary and outside your usual duties. What is your response?'
        ]);
        $q56->options()->createMany([
            ['option_text' => 'A. Decline because it is outside your job description.', 'is_correct' => false],
            ['option_text' => 'B. Agree but contribute minimally to avoid extra workload.', 'is_correct' => false],
            ['option_text' => 'C. Actively join the committee, contribute insights from your clinical experience, and help implement patient-centered improvements.', 'is_correct' => true],
            ['option_text' => 'D. Join only if you receive additional compensation.', 'is_correct' => false],
        ]);

        // --- 4th Year Section: Motivation ---

        // Question 1
        $q57 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Motivation',
            'question_text' => 'After two months of working in a busy emergency department, you feel physically and emotionally drained and begin to dread going to work. What is the most constructive response to these feelings?'
        ]);
        $q57->options()->createMany([
            ['option_text' => 'A. Push through the fatigue without acknowledging it—nurses are expected to endure.', 'is_correct' => false],
            ['option_text' => 'B. Resign from the department immediately to protect your mental health.', 'is_correct' => false],
            ['option_text' => 'C. Recognize early signs of burnout, seek peer support or professional counseling, practice self-care strategies, and discuss workload concerns with your supervisor.', 'is_correct' => true],
            ['option_text' => 'D. Reduce effort at work to conserve energy and survive the shift.', 'is_correct' => false],
        ]);

        // Question 2
        $q58 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Motivation',
            'question_text' => 'You discover that a nurse who completed a similar nursing program as you is earning significantly more in a private hospital. You are currently working in a government hospital that you chose because of its mission. How do you process this?'
        ]);
        $q58->options()->createMany([
            ['option_text' => 'A. Immediately resign and apply to the higher-paying hospital.', 'is_correct' => false],
            ['option_text' => 'B. Feel resentful toward your institution and disengage from your work.', 'is_correct' => false],
            ['option_text' => 'C. Acknowledge the difference, reflect on your personal values and long-term career goals, explore salary negotiation or advancement opportunities within your current role, and reconnect with your purpose.', 'is_correct' => true],
            ['option_text' => 'D. Ignore the information entirely and never think about your financial goals.', 'is_correct' => false],
        ]);

        // Question 3
        $q59 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Motivation',
            'question_text' => 'A patient you have been closely caring for for a week unexpectedly dies during your shift. You feel a strong sense of grief and guilt. How do you best handle this experience?'
        ]);
        $q59->options()->createMany([
            ['option_text' => 'A. Suppress your emotions and continue the shift as if nothing happened.', 'is_correct' => false],
            ['option_text' => 'B. Leave the ward for the rest of the shift to compose yourself.', 'is_correct' => false],
            ['option_text' => 'C. Allow yourself to briefly process the loss, continue patient care responsibilities, debrief with a supervisor or colleague afterward, and seek grief counseling if needed.', 'is_correct' => true],
            ['option_text' => 'D. Become detached from all patients in the future to avoid similar feelings.', 'is_correct' => false],
        ]);

        // Question 4
        $q60 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Motivation',
            'question_text' => 'You receive critical feedback from your clinical supervisor stating that your patient education approach needs significant improvement. How do you most productively respond?'
        ]);
        $q60->options()->createMany([
            ['option_text' => 'A. Dismiss the feedback as unfair and do nothing differently.', 'is_correct' => false],
            ['option_text' => 'B. Feel defeated and consider leaving the nursing profession.', 'is_correct' => false],
            ['option_text' => 'C. Thank your supervisor for the feedback, ask for specific examples and improvement strategies, and create a personal development plan to address the gap.', 'is_correct' => true],
            ['option_text' => 'D. Agree verbally but make no real changes to avoid further criticism.', 'is_correct' => false],
        ]);

        // Question 5
        $q61 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Motivation',
            'question_text' => 'After six months of working as a staff nurse, you feel your daily tasks have become routine and no longer challenging. What is the most motivation-sustaining response?'
        ]);
        $q61->options()->createMany([
            ['option_text' => 'A. Accept the routine as inevitable and lower your expectations.', 'is_correct' => false],
            ['option_text' => 'B. Request a transfer to a new unit, pursue continuing education, or take on a new role such as preceptor or committee member to reinvigorate your practice.', 'is_correct' => true],
            ['option_text' => 'C. Do only the minimum required since there is nothing new to learn.', 'is_correct' => false],
            ['option_text' => 'D. Complain to colleagues about the lack of challenge to get sympathy.', 'is_correct' => false],
        ]);

        // Question 6
        $q62 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Motivation',
            'question_text' => 'You are preparing for the Philippine Nursing Licensure Examination (PNLE) while completing your final practicum. You feel overwhelmed by the dual demands. What is the BEST approach?'
        ]);
        $q62->options()->createMany([
            ['option_text' => 'A. Focus entirely on the PNLE and put in minimal effort in practicum.', 'is_correct' => false],
            ['option_text' => 'B. Prioritize your practicum duties and delay PNLE review until after graduation.', 'is_correct' => false],
            ['option_text' => 'C. Create a structured study-and-practicum schedule, use evidence-based review strategies, set realistic daily goals, and seek support from peers and instructors.', 'is_correct' => true],
            ['option_text' => 'D. Ask to be excused from practicum to maximize PNLE preparation.', 'is_correct' => false],
        ]);

        // Question 7
        $q63 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Motivation',
            'question_text' => 'A patient tells you, \'You\'re the first nurse who actually listened to me in this hospital.\' This positive feedback affects you. What is the most growth-oriented response?'
        ]);
        $q63->options()->createMany([
            ['option_text' => 'A. Feel proud momentarily but don\'t change anything in your practice.', 'is_correct' => false],
            ['option_text' => 'B. Use the experience as motivation to advocate for patient-centered care improvements in your unit, share the feedback with your team, and continue modeling compassionate care.', 'is_correct' => true],
            ['option_text' => 'C. Tell other nurses they should communicate better based on this one patient\'s comment.', 'is_correct' => false],
            ['option_text' => 'D. Share the comment on social media to highlight your personal achievement.', 'is_correct' => false],
        ]);

        // Question 8
        $q64 = Question::create([
            'year_level' => '4th Year',
            'section' => 'Motivation',
            'question_text' => 'You are offered a scholarship for a Master\'s degree in Nursing, but it will require you to work in a rural health unit for two years after completion. You are currently comfortable in a city-based hospital. What is your most professionally motivated response?'
        ]);
        $q64->options()->createMany([
            ['option_text' => 'A. Decline immediately because rural work is outside your comfort zone.', 'is_correct' => false],
            ['option_text' => 'B. Accept without thinking through the commitment just because it is a scholarship.', 'is_correct' => false],
            ['option_text' => 'C. Carefully weigh the opportunity against your career goals, consider the public health impact, and if it aligns with your values and long-term plans, accept and prepare meaningfully for the experience.', 'is_correct' => true],
            ['option_text' => 'D. Accept but plan to find a way out of the rural assignment after graduation.', 'is_correct' => false],
        ]);
    }
}
