import pickle
import numpy as np

model = pickle.load(open("model.pkl", "rb"))

def rank(df):

    features = df[[
        "intent_score",
        "skill_gap_score",
        "engagement_score",
        "milestone_progress",
        "pathway_confidence"
    ]].values

    probabilities = model.predict_proba(features)[:, 1]

    recommendations = [
        ("Advanced Skill Module", probabilities[0], "High readiness"),
        ("Collaborative Project Sprint", probabilities[0] * 0.9, "Low collaboration exposure")
    ]

    return recommendations
